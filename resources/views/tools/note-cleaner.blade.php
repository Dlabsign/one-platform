<x-layout title="AI Note Cleaner - PDF Planet">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            
            {{-- Header --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/25 text-blue-400 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Powered by Gemini AI
                </div>
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">AI Note Cleaner</h1>
                <p class="text-slate-400 font-light text-lg max-w-2xl mx-auto">Rapikan catatan kuliah atau rapatmu yang berantakan hanya dengan satu klik. AI akan menyusunnya menjadi rapi dan mudah dibaca.</p>
            </div>

            {{-- Main Workspace --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                
                {{-- KIRI: INPUT --}}
                <div class="bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 flex flex-col h-[600px]">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-white font-['Syne',sans-serif] flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Catatan Mentah
                        </h2>
                        
                        <select id="formatStyle" class="bg-gray-800 border border-white/10 text-slate-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2 outline-none">
                            <option value="bullet">Rapikan & Poin-poin</option>
                            <option value="formal">Jadikan Paragraf Formal</option>
                            <option value="summary">Buat Ringkasan Singkat</option>
                        </select>
                    </div>

                    <textarea id="messyInput" class="w-full flex-1 bg-black/40 border border-white/5 rounded-xl p-4 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 transition resize-none custom-scroll" placeholder="Paste catatan berantakan kamu di sini...&#10;&#10;Contoh:&#10;rapat tdi bahas marketing q3 hrus naik 20% budget sosmed ditambah 5jt hrus fokus ke tiktok dlu bulan depan launching..."></textarea>
                    
                    <button id="cleanBtn" class="mt-4 w-full bg-blue-600 hover:bg-blue-500 text-white py-3.5 rounded-xl font-bold shadow-[0_0_20px_rgba(37,99,235,0.2)] transition-all flex items-center justify-center space-x-2 relative overflow-hidden group">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            <span id="cleanBtnText">Bersihkan Catatan</span>
                        </span>
                        <div class="absolute inset-0 h-full w-full bg-gradient-to-r from-blue-600 via-indigo-500 to-blue-600 -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] z-0"></div>
                    </button>
                </div>

                {{-- KANAN: OUTPUT --}}
                <div class="bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 flex flex-col h-[600px] relative">
                    
                    {{-- Loading Overlay (Saat AI Bekerja) --}}
                    <div id="loadingOverlay" class="absolute inset-0 bg-gray-900/90 backdrop-blur-sm rounded-[24px] flex flex-col items-center justify-center z-20 hidden">
                        <div class="w-16 h-16 border-4 border-blue-500/20 border-t-blue-500 rounded-full animate-spin mb-4"></div>
                        <p class="text-blue-400 font-bold font-['Syne',sans-serif] animate-pulse">AI Sedang Merapikan...</p>
                    </div>

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-bold text-white font-['Syne',sans-serif] flex items-center gap-2">
                            <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Hasil Rapih
                        </h2>
                        
                        <button id="copyBtn" class="text-slate-400 hover:text-white bg-white/5 hover:bg-white/10 px-3 py-1.5 rounded-lg text-sm font-semibold transition flex items-center gap-1.5 opacity-50 cursor-not-allowed" disabled>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            <span>Copy</span>
                        </button>
                    </div>

                    <textarea id="cleanOutput" class="w-full flex-1 bg-black/40 border border-white/5 rounded-xl p-4 text-slate-200 focus:outline-none resize-none custom-scroll" readonly placeholder="Hasil catatan dari AI akan muncul di sini..."></textarea>
                </div>

            </div>
        </div>
    </div>

    <style>
        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: rgba(255,255,255,0.02); border-radius: 8px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: rgba(37,99,235,0.5); border-radius: 8px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(37,99,235,0.8); }
        
        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes shimmer {
            100% { transform: translateX(100%); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cleanBtn = document.getElementById('cleanBtn');
            const messyInput = document.getElementById('messyInput');
            const cleanOutput = document.getElementById('cleanOutput');
            const formatStyle = document.getElementById('formatStyle');
            const loadingOverlay = document.getElementById('loadingOverlay');
            const copyBtn = document.getElementById('copyBtn');

            cleanBtn.addEventListener('click', async function() {
                const text = messyInput.value.trim();
                if (!text) {
                    alert('Harap masukkan catatan yang ingin dirapikan!');
                    return;
                }

                // Tampilkan Loading
                loadingOverlay.classList.remove('hidden');
                cleanBtn.disabled = true;

                try {
                    // Panggil Backend Laravel
                    const response = await fetch("{{ route('tools.processNotes') }}", {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            notes: text,
                            format: formatStyle.value
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) throw new Error(data.message || 'Gagal terhubung ke AI');

                    // Tampilkan Hasil
                    cleanOutput.value = data.result;
                    
                    // Aktifkan tombol copy
                    copyBtn.disabled = false;
                    copyBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    copyBtn.classList.add('text-blue-400');

                } catch (error) {
                    alert('Error: ' + error.message);
                } finally {
                    loadingOverlay.classList.add('hidden');
                    cleanBtn.disabled = false;
                }
            });

            // Logika Tombol Copy
            copyBtn.addEventListener('click', function() {
                cleanOutput.select();
                document.execCommand('copy');
                
                // Animasi centang sementara
                const originalHtml = copyBtn.innerHTML;
                copyBtn.innerHTML = `<svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> <span class="text-green-400">Copied!</span>`;
                setTimeout(() => { copyBtn.innerHTML = originalHtml; }, 2000);
            });
        });
    </script>
</x-layout>