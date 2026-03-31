<x-layout title="Merge PDF - PDF Planet">
    <x-navbar />

    <!-- <div class="pt-10 pb-20 max-w-4xl mx-auto px-4"> -->
    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-8 pb-16">
        <div class="max-w-7xl mx-auto px-4">

            {{-- Header Section --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Merge PDF Files</h1>
                <p class="text-slate-400 font-light text-lg">Pilih file, seret (drag) untuk mengatur urutan, lalu klik Proses.</p>
            </div>

            {{-- Main Card --}}
            <div class="bg-gray-900/80 backdrop-blur-md p-8 md:p-12 rounded-[32px] shadow-2xl border border-white/10 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">

                {{-- Upload Button --}}
                <div class="flex justify-center mb-8">
                    <label class="cursor-pointer bg-violet-500/10 text-violet-400 hover:bg-violet-500 hover:text-gray-900 transition-all duration-300 px-8 py-3.5 rounded-full font-bold shadow-[0_0_20px_rgba(167,139,250,0.15)] hover:shadow-[0_0_20px_rgba(167,139,250,0.4)] flex items-center space-x-2 border border-violet-500/30 hover:border-violet-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Pilih File PDF</span>
                        <input type="file" id="fileInput" accept=".pdf" multiple class="hidden">
                    </label>
                </div>

                {{-- Custom Scrollbar untuk list file (Opsional jika listnya panjang) --}}
                <style>
                    .custom-scroll::-webkit-scrollbar {
                        width: 6px;
                    }

                    .custom-scroll::-webkit-scrollbar-track {
                        background: rgba(255, 255, 255, 0.02);
                        border-radius: 8px;
                    }

                    .custom-scroll::-webkit-scrollbar-thumb {
                        background: rgba(255, 255, 255, 0.1);
                        border-radius: 8px;
                    }

                    .custom-scroll::-webkit-scrollbar-thumb:hover {
                        background: rgba(255, 255, 255, 0.2);
                    }

                    @keyframes fadeSlideUp {
                        from {
                            opacity: 0;
                            transform: translateY(20px);
                        }

                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>

                {{-- File List Area --}}
                <ul id="fileList" class="space-y-3 mb-8 min-h-[160px] max-h-[400px] overflow-y-auto custom-scroll border-2 border-dashed border-white/10 hover:border-violet-400/30 transition-colors duration-300 rounded-[24px] p-6 bg-black/20">

                    <li id="emptyState" class="text-center text-slate-500 py-8 flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                        <span class="font-medium">Belum ada file yang dipilih.</span>
                    </li>

                </ul>

                {{-- Action Button --}}
                <div class="flex justify-end hidden" id="actionButtons">
                    <button id="processBtn" class="bg-violet-500 hover:bg-violet-400 text-gray-900 px-8 py-3.5 rounded-xl font-bold shadow-[0_0_15px_rgba(167,139,250,0.2)] transition-all flex items-center space-x-2">
                        <span>Gabungkan PDF Sekarang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>

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
                ghostClass: 'opacity-40' // Diubah agar cocok dengan dark mode
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
                    // Class Tailwind diubah menjadi Dark Mode Version
                    li.className = 'flex items-center justify-between p-4 bg-gray-800/50 border border-white/5 rounded-xl shadow-sm cursor-grab active:cursor-grabbing hover:border-violet-400/40 hover:bg-gray-800 transition-all';
                    li.setAttribute('data-id', uniqueId);

                    li.innerHTML = `
                        <div class="flex items-center space-x-4 truncate">
                            <div class="p-2.5 bg-violet-500/20 text-violet-400 rounded-lg border border-violet-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="font-medium text-slate-200 truncate">${file.name}</span>
                        </div>
                        <button type="button" class="text-slate-500 hover:text-red-400 hover:bg-red-500/10 rounded-md delete-btn p-2 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    `;

                    // Fungsi untuk menghapus item dari list
                    li.querySelector('.delete-btn').addEventListener('click', function() {
                        delete fileStore[uniqueId];
                        li.remove();
                        if (Object.keys(fileStore).length === 0) {
                            emptyState.style.display = 'flex'; // kembalikan jadi flex agar icon di tengah
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
                processBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memproses...</span>
                `;
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
                        headers: {
                            'Accept': 'application/pdf'
                        }
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