<x-layout title="Merge PDF - PDF Planet">
    <x-navbar />

    <div class="max-w-4xl mx-auto mt-10 px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Merge PDF Files</h1>
            <p class="text-gray-500 mt-2">Pilih file, seret (drag) untuk mengatur urutan, lalu klik Proses.</p>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
            
            <div class="flex justify-center mb-6">
                <label class="cursor-pointer bg-purple-100 text-purple-700 hover:bg-purple-600 hover:text-white transition px-6 py-3 rounded-lg font-semibold shadow-sm flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>Pilih File PDF</span>
                    <input type="file" id="fileInput" accept=".pdf" multiple class="hidden">
                </label>
            </div>

            <ul id="fileList" class="space-y-3 mb-6 min-h-[100px] border-2 border-dashed border-gray-200 rounded-lg p-4 bg-gray-50">
                <li id="emptyState" class="text-center text-gray-400 py-8">Belum ada file yang dipilih.</li>
            </ul>

            <div class="flex justify-end hidden" id="actionButtons">
                <button id="processBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold shadow-md transition flex items-center space-x-2">
                    <span>Gabungkan PDF Sekarang</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </button>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const fileList = document.getElementById('fileList');
            const emptyState = document.getElementById('emptyState');
            const actionButtons = document.getElementById('actionButtons');
            const processBtn = document.getElementById('processBtn');

            // Kita menyimpan objek file mentah di sini, menggunakan ID unik sebagai kunci
            let fileStore = {}; 
            let fileCounter = 0;

            // 1. Aktifkan SortableJS pada list
            new Sortable(fileList, {
                animation: 150,
                ghostClass: 'bg-gray-100' // Warna latar saat ditarik
            });

            // 2. Saat user memilih file
            fileInput.addEventListener('change', function(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    emptyState.style.display = 'none';
                    actionButtons.classList.remove('hidden');
                }

                Array.from(files).forEach(file => {
                    let uniqueId = 'file_' + fileCounter++;
                    fileStore[uniqueId] = file; // Simpan file ke memori sementara

                    // Buat elemen visual (kotak list)
                    let li = document.createElement('li');
                    li.className = 'flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm cursor-grab active:cursor-grabbing hover:border-purple-300 transition';
                    li.setAttribute('data-id', uniqueId);
                    
                    li.innerHTML = `
                        <div class="flex items-center space-x-3 truncate">
                            <div class="p-2 bg-red-100 text-red-600 rounded">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium text-gray-700 truncate">${file.name}</span>
                        </div>
                        <button type="button" class="text-gray-400 hover:text-red-500 delete-btn p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    `;

                    // Fungsi untuk menghapus item dari list
                    li.querySelector('.delete-btn').addEventListener('click', function() {
                        delete fileStore[uniqueId];
                        li.remove();
                        if (Object.keys(fileStore).length === 0) {
                            emptyState.style.display = 'block';
                            actionButtons.classList.add('hidden');
                        }
                    });

                    fileList.appendChild(li);
                });

                // Kosongkan input agar user bisa pilih file yang sama lagi jika perlu
                fileInput.value = ''; 
            });

            // 3. Saat user klik proses
            processBtn.addEventListener('click', function() {
                const listItems = fileList.querySelectorAll('li[data-id]');
                
                if (listItems.length < 2) {
                    alert('Harap masukkan minimal 2 file PDF untuk digabungkan.');
                    return;
                }

                // Ubah tombol jadi loading
                const originalText = processBtn.innerHTML;
                processBtn.innerHTML = 'Memproses...';
                processBtn.disabled = true;
                processBtn.classList.add('opacity-75', 'cursor-not-allowed');

                // Siapkan data form yang akan dikirim (mengikuti urutan terbaru di layar)
                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                
                listItems.forEach(li => {
                    let id = li.getAttribute('data-id');
                    formData.append('pdf_files[]', fileStore[id]);
                });

                // Kirim ke backend Laravel via Ajax (Fetch)
                fetch("{{ route('convert.mergePdf') }}", {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/pdf' }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memproses PDF');
                    return response.blob();
                })
                .then(blob => {
                    // Buat link download otomatis
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.style.display = 'none';
                    a.href = url;
                    a.download = 'Dokumen-Gabungan.pdf';
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);
                    
                    // Kembalikan tombol ke keadaan semula
                    processBtn.innerHTML = originalText;
                    processBtn.disabled = false;
                    processBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                })
                .catch(error => {
                    alert(error.message);
                    processBtn.innerHTML = originalText;
                    processBtn.disabled = false;
                    processBtn.classList.remove('opacity-75', 'cursor-not-allowed');
                });
            });
        });
    </script>
</x-layout>