<x-layout title="Image to PDF - Editor - PDF Planet">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-8 pb-16">
        <div class="max-w-7xl mx-auto px-4">

            {{-- STEP 1: Drag & Drop Container --}}
            <div id="step1Container" class="max-w-4xl mx-auto text-center mt-16 [animation:fadeSlideUp_0.6s_ease_both]">
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-4">Ubah Gambar ke PDF</h1>
                <p class="text-slate-400 mb-10 text-lg font-light">Pilih gambar (JPG/PNG), atur posisinya, dan lihat hasilnya secara langsung sebelum di-download.</p>

                <div class="bg-amber-500/5 p-12 rounded-[32px] shadow-2xl border-2 border-dashed border-white/10 hover:border-amber-400/50 transition-colors duration-300 backdrop-blur-sm group">
                    <div class="w-20 h-20 mx-auto bg-amber-500/10 text-amber-400 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-2 font-['Syne',sans-serif]">Seret & Lepas Gambar Di Sini</h3>
                    <p class="text-slate-500 mb-8">atau klik tombol di bawah ini</p>
                    
                    <label class="cursor-pointer bg-amber-500 hover:bg-amber-400 text-gray-900 transition-colors px-8 py-3.5 rounded-full font-bold shadow-[0_0_20px_rgba(251,191,36,0.2)] inline-block">
                        <span>Pilih Gambar (JPG / PNG)</span>
                        <input type="file" id="fileInput" accept="image/png, image/jpeg, image/jpg" multiple class="hidden">
                    </label>
                </div>
            </div>

            {{-- STEP 2: Editor Container --}}
            <div id="step2Container" class="hidden">
                
                {{-- Top Bar --}}
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 bg-gray-900/80 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-white/10 [animation:fadeSlideUp_0.4s_ease_both]">
                    <button id="backBtn" class="text-slate-400 hover:text-red-400 font-medium flex items-center space-x-2 transition mb-4 md:mb-0 bg-white/5 hover:bg-white/10 px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span>Batal & Kembali</span>
                    </button>
                    <h2 class="text-xl font-extrabold text-white font-['Syne',sans-serif] tracking-wide">Editor <span class="text-amber-400">PDF</span></h2>
                    <button id="downloadBtn" class="bg-teal-500 hover:bg-teal-400 text-gray-900 px-8 py-2.5 rounded-xl font-bold shadow-[0_0_15px_rgba(45,212,191,0.2)] transition flex items-center space-x-2 opacity-50 cursor-not-allowed" disabled>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Download PDF</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                    
                    {{-- Sidebar Settings --}}
                    <div class="lg:col-span-4 xl:col-span-3 space-y-4 [animation:fadeSlideUp_0.5s_ease_both]">
                        
                        {{-- Print Settings --}}
                        <div class="bg-gray-900/80 backdrop-blur-md p-5 rounded-[24px] shadow-lg border border-white/10">
                            <h3 class="font-bold text-white mb-4 border-b border-white/10 pb-3 font-['Syne',sans-serif]">Pengaturan Cetak</h3>
                            <div class="grid grid-cols-2 lg:grid-cols-1 gap-4 mb-5">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Orientasi</label>
                                    <select id="settingOrientation" class="w-full rounded-xl text-sm p-3 bg-gray-800 border border-white/10 text-white focus:border-amber-400 focus:ring-1 focus:ring-amber-400 outline-none transition">
                                        <option value="portrait">Berdiri (Portrait)</option>
                                        <option value="landscape">Mendatar (Landscape)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Margin</label>
                                    <select id="settingMargin" class="w-full rounded-xl text-sm p-3 bg-gray-800 border border-white/10 text-white focus:border-amber-400 focus:ring-1 focus:ring-amber-400 outline-none transition">
                                        <option value="none">Tanpa Margin</option>
                                        <option value="small">Kecil</option>
                                        <option value="big">Besar</option>
                                    </select>
                                </div>
                            </div>
                            <button id="updatePreviewBtn" class="w-full bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 py-3 rounded-xl font-bold transition border border-amber-500/30 flex justify-center items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                <span>Terapkan & Update</span>
                            </button>
                        </div>

                        {{-- Image List --}}
                        <div class="bg-gray-900/80 backdrop-blur-md p-5 rounded-[24px] shadow-lg border border-white/10">
                            <div class="flex justify-between items-center mb-4 border-b border-white/10 pb-3">
                                <h3 class="font-bold text-white font-['Syne',sans-serif]">Urutan Gambar</h3>
                                <label class="cursor-pointer text-xs bg-white/5 hover:bg-white/10 text-amber-400 px-3 py-1.5 rounded-lg font-semibold transition">
                                    + Tambah
                                    <input type="file" id="addMoreFileInput" accept="image/png, image/jpeg, image/jpg" multiple class="hidden">
                                </label>
                            </div>
                            
                            {{-- Custom Scrollbar untuk list --}}
                            <style>
                                .custom-scroll::-webkit-scrollbar { width: 6px; }
                                .custom-scroll::-webkit-scrollbar-track { background: rgba(255,255,255,0.02); border-radius: 8px; }
                                .custom-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 8px; }
                                .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
                            </style>
                            
                            <ul id="fileList" class="space-y-2.5 min-h-[200px] max-h-[350px] overflow-y-auto pr-2 custom-scroll">
                            </ul>
                        </div>
                    </div>

                    {{-- Main Preview Area --}}
                    <div class="lg:col-span-8 xl:col-span-9 [animation:fadeSlideUp_0.6s_ease_both]">
                        <div class="bg-black/40 rounded-[24px] p-2 h-[700px] flex items-center justify-center relative shadow-inner border border-white/5 overflow-hidden">
                            
                            {{-- Loading Overlay --}}
                            <div id="loadingOverlay" class="absolute inset-0 bg-[#0b0f1a]/80 backdrop-blur-sm flex flex-col items-center justify-center text-amber-400 hidden z-10 transition-all">
                                <svg class="animate-spin h-12 w-12 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="font-bold text-lg font-['Syne',sans-serif] tracking-wide text-white">Membangun PDF...</span>
                            </div>

                            {{-- Empty State --}}
                            <div id="emptyPreview" class="text-slate-600 text-center">
                                <svg class="w-20 h-20 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p class="font-medium">Preview PDF akan muncul di sini</p>
                            </div>

                            <iframe id="pdfIframe" class="w-full h-full bg-white rounded-[16px] hidden shadow-2xl"></iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script Animasi --}}
    <style>
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Deklarasi Elemen
            const step1Container = document.getElementById('step1Container');
            const step2Container = document.getElementById('step2Container');
            const fileInput = document.getElementById('fileInput');
            const addMoreFileInput = document.getElementById('addMoreFileInput');
            const fileList = document.getElementById('fileList');
            const backBtn = document.getElementById('backBtn');
            const updatePreviewBtn = document.getElementById('updatePreviewBtn');
            const downloadBtn = document.getElementById('downloadBtn');
            const pdfIframe = document.getElementById('pdfIframe');
            const emptyPreview = document.getElementById('emptyPreview');
            const loadingOverlay = document.getElementById('loadingOverlay');

            let fileStore = {};
            let fileCounter = 0;
            let currentPdfBlobUrl = null; 

            // 1. Inisialisasi Fitur Drag & Drop
            new Sortable(fileList, {
                animation: 150,
                ghostClass: 'opacity-40', // Diubah agar sesuai dark mode
                onEnd: function() {
                    // Update Class Tailwind untuk tombol peringatan (Dark Mode Version)
                    updatePreviewBtn.classList.remove('bg-amber-500/10', 'text-amber-400', 'border-amber-500/30');
                    updatePreviewBtn.classList.add('bg-red-500/20', 'text-red-400', 'border-red-500/30', 'animate-pulse');
                    updatePreviewBtn.innerHTML = '<span class="text-sm">⚠️ Susunan Berubah! Update Preview</span>';
                }
            });

            // 2. Fungsi Menangani Input File
            function handleFiles(files) {
                if (files.length === 0) return;

                step1Container.classList.add('hidden');
                step2Container.classList.remove('hidden');

                Array.from(files).forEach(file => {
                    let uniqueId = 'file_' + fileCounter++;
                    fileStore[uniqueId] = file;

                    let li = document.createElement('li');
                    // Update Class Tailwind untuk list item gambar
                    li.className = 'flex items-center justify-between p-3 bg-gray-800/50 border border-white/5 rounded-xl shadow-sm cursor-grab active:cursor-grabbing hover:border-amber-400/40 hover:bg-gray-800 transition-all';
                    li.setAttribute('data-id', uniqueId);

                    li.innerHTML = `
                        <div class="flex items-center space-x-3 truncate w-full">
                            <img src="" class="w-10 h-10 object-cover rounded-lg bg-gray-900 border border-white/10 preview-thumb" alt="thumb">
                            <span class="text-sm font-medium text-slate-200 truncate w-3/4">${file.name}</span>
                        </div>
                        <button type="button" class="text-slate-500 hover:text-red-400 hover:bg-red-500/10 rounded-md delete-btn p-1.5 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    `;

                    // Generate Thumbnail
                    let reader = new FileReader();
                    reader.onload = function(e) { li.querySelector('.preview-thumb').src = e.target.result; }
                    reader.readAsDataURL(file);

                    // Fungsi Hapus Item
                    li.querySelector('.delete-btn').addEventListener('click', function() {
                        delete fileStore[uniqueId];
                        li.remove();
                        
                        // Setel tombol update menyala jika ada item yg dihapus
                        if(Object.keys(fileStore).length > 0) {
                            updatePreviewBtn.classList.remove('bg-amber-500/10', 'text-amber-400', 'border-amber-500/30');
                            updatePreviewBtn.classList.add('bg-red-500/20', 'text-red-400', 'border-red-500/30', 'animate-pulse');
                            updatePreviewBtn.innerHTML = '<span class="text-sm">⚠️ Gambar Dihapus! Update Preview</span>';
                        }

                        if (Object.keys(fileStore).length === 0) {
                            step1Container.classList.remove('hidden');
                            step2Container.classList.add('hidden');
                            pdfIframe.src = '';
                            pdfIframe.classList.add('hidden');
                            emptyPreview.classList.remove('hidden');
                        }
                    });

                    fileList.appendChild(li);
                });

                // Otomatis jalankan preview saat pertama kali file dimasukkan
                generatePreview();
            }

            fileInput.addEventListener('change', (e) => handleFiles(e.target.files));
            addMoreFileInput.addEventListener('change', (e) => {
                handleFiles(e.target.files);
                addMoreFileInput.value = ''; 
            });

            // 3. Tombol Kembali
            backBtn.addEventListener('click', function() {
                if(confirm("Yakin ingin membatalkan? Semua gambar akan dihapus.")) {
                    fileStore = {};
                    fileList.innerHTML = '';
                    step2Container.classList.add('hidden');
                    step1Container.classList.remove('hidden');
                    pdfIframe.src = '';
                    pdfIframe.classList.add('hidden');
                    emptyPreview.classList.remove('hidden');
                    downloadBtn.disabled = true;
                    downloadBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            });

            // 4. Proses Request ke Server
            function generatePreview() {
                const listItems = fileList.querySelectorAll('li[data-id]');
                if (listItems.length === 0) return;

                loadingOverlay.classList.remove('hidden');
                updatePreviewBtn.disabled = true;

                let formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('orientation', document.getElementById('settingOrientation').value);
                formData.append('margin', document.getElementById('settingMargin').value);

                listItems.forEach(li => {
                    let id = li.getAttribute('data-id');
                    formData.append('images[]', fileStore[id]);
                });

                fetch("{{ route('convert.imageToPdf') }}", {
                    method: 'POST',
                    body: formData,
                    headers: { 'Accept': 'application/pdf', 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(async response => {
                    if (!response.ok) throw new Error('Gagal! Pastikan file tidak terlalu besar.');
                    return response.blob();
                })
                .then(blob => {
                    if(currentPdfBlobUrl) window.URL.revokeObjectURL(currentPdfBlobUrl);
                    
                    currentPdfBlobUrl = window.URL.createObjectURL(blob);
                    
                    emptyPreview.classList.add('hidden');
                    pdfIframe.classList.remove('hidden');
                    pdfIframe.src = currentPdfBlobUrl;

                    downloadBtn.disabled = false;
                    downloadBtn.classList.remove('opacity-50', 'cursor-not-allowed');

                    // Kembalikan desain tombol Update ke warna normal (Dark Mode)
                    updatePreviewBtn.classList.remove('bg-red-500/20', 'text-red-400', 'border-red-500/30', 'animate-pulse');
                    updatePreviewBtn.classList.add('bg-amber-500/10', 'text-amber-400', 'border-amber-500/30');
                    updatePreviewBtn.innerHTML = `<svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg> Terapkan & Update`;
                })
                .catch(error => {
                    alert(error.message);
                })
                .finally(() => {
                    loadingOverlay.classList.add('hidden');
                    updatePreviewBtn.disabled = false;
                });
            }

            updatePreviewBtn.addEventListener('click', generatePreview);
            document.getElementById('settingOrientation').addEventListener('change', generatePreview);
            document.getElementById('settingMargin').addEventListener('change', generatePreview);

            // 5. Eksekusi Download 
            downloadBtn.addEventListener('click', function() {
                if(!currentPdfBlobUrl) return;
                
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = currentPdfBlobUrl;
                a.download = 'Planet-PDF-Images.pdf';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });

        });
    </script>
</x-layout>