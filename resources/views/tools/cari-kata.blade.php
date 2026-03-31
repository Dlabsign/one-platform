<x-layout title="Cari Kata KBBI - PDF Planet">
    <x-navbar />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 8px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(99, 102, 241, 0.3);
            border-radius: 8px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(99, 102, 241, 0.6);
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

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-8 pb-20">
        <div class="max-w-4xl mx-auto px-4 md:px-8">

            {{-- HEADER --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="inline-flex items-center gap-2 bg-indigo-500/10 border border-indigo-500/25 text-indigo-400 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Kamus Besar Bahasa Indonesia
                </div>
                <h1 class="text-[clamp(2rem,5vw,3.5rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Cari <span class="text-indigo-400">Kata</span></h1>
                <p class="text-slate-400 font-light text-lg">Temukan arti kata, ejaan baku, dan kelas kata resmi sesuai referensi KBBI.</p>
            </div>

            {{-- SEARCH BOX --}}
            <div class="bg-gray-900/80 backdrop-blur-md p-3 md:p-4 rounded-[24px] shadow-2xl border border-white/10 flex items-center gap-3 mb-10 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                <div class="pl-4 text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="wordInput" class="w-full bg-transparent border-none text-slate-200 text-lg md:text-xl placeholder-slate-600 focus:outline-none focus:ring-0 px-2" placeholder="Masukkan kata (contoh: efektif, dan, apotek)..." autocomplete="off">
                <button id="searchBtn" class="bg-indigo-500 hover:bg-indigo-400 text-white px-6 md:px-10 py-3.5 rounded-[18px] font-bold shadow-[0_0_20px_rgba(99,102,241,0.2)] transition-all flex items-center justify-center whitespace-nowrap">
                    Cari Kata
                </button>
            </div>

            {{-- RESULTS CONTAINER --}}
            <div id="resultContainer" class="hidden [animation:fadeSlideUp_0.6s_ease_both]">

                {{-- LOADING STATE --}}
                <div id="loadingState" class="hidden text-center py-16 bg-gray-900/50 backdrop-blur-md rounded-[28px] border border-white/5">
                    <div class="w-14 h-14 border-4 border-indigo-500/20 border-t-indigo-500 rounded-full animate-spin mx-auto mb-4"></div>
                    <p class="text-indigo-400 font-bold font-['Syne',sans-serif] animate-pulse">Mencari di dalam KBBI...</p>
                </div>

                {{-- ERROR STATE --}}
                <div id="errorState" class="hidden text-center py-16 bg-red-500/5 backdrop-blur-md rounded-[28px] border border-red-500/20">
                    <svg class="w-16 h-16 text-red-400/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-slate-200 mb-2 font-['Syne',sans-serif]">Kata Tidak Ditemukan</h3>
                    <p id="errorMsg" class="text-slate-400">Pastikan ejaan kata sudah benar dan baku.</p>
                </div>

                {{-- SUCCESS CONTENT --}}
                <div id="successState" class="hidden space-y-6">
                    {{-- Diisi oleh JavaScript --}}
                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wordInput = document.getElementById('wordInput');
            const searchBtn = document.getElementById('searchBtn');
            const resultContainer = document.getElementById('resultContainer');
            const loadingState = document.getElementById('loadingState');
            const errorState = document.getElementById('errorState');
            const errorMsg = document.getElementById('errorMsg');
            const successState = document.getElementById('successState');

            // Bisa submit pakai tombol Enter
            wordInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') searchWord();
            });
            searchBtn.addEventListener('click', searchWord);

            async function searchWord() {
                const word = wordInput.value.trim();
                if (!word) return;

                // Tampilkan container dan loading
                resultContainer.classList.remove('hidden');
                successState.classList.add('hidden');
                errorState.classList.add('hidden');
                loadingState.classList.remove('hidden');
                searchBtn.disabled = true;

                try {
                    const res = await fetch("{{ route('tools.processCariKata') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            word: word
                        })
                    });

                    const responseData = await res.json();

                    if (!res.ok || !responseData.success) {
                        throw new Error(responseData.message || 'Gagal mencari kata.');
                    }

                    // Render Hasil
                    renderResults(responseData.result);

                    loadingState.classList.add('hidden');
                    successState.classList.remove('hidden');

                } catch (error) {
                    loadingState.classList.add('hidden');
                    errorState.classList.remove('hidden');
                    errorMsg.textContent = error.message;
                } finally {
                    searchBtn.disabled = false;
                }
            }

            // Fungsi render hasil yang sudah diperbaiki sesuai struktur JSON API
            function renderResults(dataArray) {
                successState.innerHTML = '';

                dataArray.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'bg-gray-900/80 backdrop-blur-md p-8 rounded-[28px] shadow-2xl border border-white/10 mb-6 last:mb-0';

                    // Lema (Judul Kata)
                    const lemaTitle = document.createElement('h2');
                    lemaTitle.className = "text-2xl md:text-3xl font-['Syne',sans-serif] font-bold text-white mb-6 tracking-wide";
                    lemaTitle.textContent = item.lema; // Menggunakan lema dari API
                    card.appendChild(lemaTitle);

                    // List Arti
                    const ol = document.createElement('ol');
                    ol.className = 'space-y-4 list-decimal list-inside text-slate-300 text-lg font-light leading-relaxed';

                    let artiList = Array.isArray(item.arti) ? item.arti : [];

                    artiList.forEach(maknaObj => {
                        const li = document.createElement('li');
                        li.className = 'pl-2 py-1 border-b border-white/5 last:border-0 pb-4';

                        // KUNCI PERBAIKAN: Ambil teks dari maknaObj.deskripsi
                        let makna = maknaObj.deskripsi || '';

                        let cleanMakna = makna;
                        let kelasKata = '';

                        // Memisahkan singkatan kelas kata (pron, n, v, a, dll) di awal kalimat
                        const match = makna.match(/^([a-z]{1,4})\s+(.*)/);
                        if (match) {
                            kelasKata = match[1];
                            cleanMakna = match[2];

                            const kelasMap = {
                                'n': 'Nomina (Kata Benda)',
                                'v': 'Verba (Kata Kerja)',
                                'p': 'Partikel / Kata Tugas',
                                'a': 'Adjektiva (Kata Sifat)',
                                'adv': 'Adverbia (Kata Keterangan)',
                                'pron': 'Pronomina (Kata Ganti)',
                                'num': 'Numeralia (Kata Bilangan)'
                            };

                            const tooltipText = kelasMap[kelasKata] || kelasKata;

                            li.innerHTML = `
                                <span class="inline-block align-middle mr-2 px-2 py-0.5 bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-xs font-bold uppercase rounded-md cursor-help" title="${tooltipText}">
                                    ${kelasKata}
                                </span>
                                <span>${cleanMakna}</span>
                            `;
                        } else {
                            li.innerHTML = `<span>${makna}</span>`;
                        }

                        ol.appendChild(li);
                    });

                    card.appendChild(ol);
                    successState.appendChild(card);
                });
            }
        });
    </script>
</x-layout>