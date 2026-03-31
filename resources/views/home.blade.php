<x-layout title="Home - PDF Planet">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen">
        {{-- Hero Section --}}
        <section class="relative min-h-[88vh] flex flex-col md:flex-row items-center justify-between gap-12 max-w-[1200px] mx-auto px-8 pt-24 pb-16 overflow-hidden">

            {{-- Background Glow & Grid --}}
            <div class="absolute top-[-120px] left-[-100px] w-[700px] h-[700px] bg-[radial-gradient(circle,rgba(45,212,191,0.12)_0%,transparent_65%)] pointer-events-none z-0"></div>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.025)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.025)_1px,transparent_1px)] bg-[size:60px_60px] pointer-events-none [mask-image:radial-gradient(ellipse_80%_80%_at_50%_50%,black_30%,transparent_100%)] z-0"></div>

            {{-- Hero Content --}}
            <div class="relative z-10 flex-1 max-w-[560px]">
                <div class="inline-flex items-center gap-2 bg-teal-400/10 border border-teal-400/25 text-teal-400 text-sm font-medium px-3.5 py-1.5 rounded-full mb-6 tracking-wide [animation:fadeSlideUp_0.6s_ease_both]">
                    <span class="w-[7px] h-[7px] bg-teal-400 rounded-full shadow-[0_0_8px_#2dd4bf] animate-pulse"></span>
                    100% Gratis · Tanpa Daftar
                </div>

                <h1 class="font-['Syne',sans-serif] text-[clamp(2rem,6vw,5rem)] font-extrabold leading-[1.05] mb-5 text-white [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                    Effortless
                    <span class="[-webkit-text-stroke:2px_#2dd4bf] text-transparent block">Student<br>Tools</span>
                    You Can Use
                </h1>

                <p class="text-[1.05rem] text-slate-500 leading-relaxed mb-10 font-light [animation:fadeSlideUp_0.6s_0.2s_ease_both]">
                    Semua alat favorit kamu di satu tempat — dari PDF, hiburan, hingga berita crypto.
                    <br>Cepat, terstruktur, dan mudah digunakan.
                </p>

                <div class="flex items-center gap-6 [animation:fadeSlideUp_0.6s_0.3s_ease_both]">
                    <div class="text-center">
                        <span class="block font-['Syne',sans-serif] text-[1.6rem] font-extrabold text-white">5+</span>
                        <span class="text-xs text-slate-500">Kategori</span>
                    </div>
                    <div class="w-px h-9 bg-white/10"></div>
                    <div class="text-center">
                        <span class="block font-['Syne',sans-serif] text-[1.6rem] font-extrabold text-white">100%</span>
                        <span class="text-xs text-slate-500">Gratis</span>
                    </div>
                    <div class="w-px h-9 bg-white/10"></div>
                    <div class="text-center">
                        <span class="block font-['Syne',sans-serif] text-[1.6rem] font-extrabold text-white">∞</span>
                        <span class="text-xs text-slate-500">Penggunaan</span>
                    </div>
                </div>
            </div>

            {{-- Hero Visual --}}
            <div class="relative z-10 shrink-0 w-[320px] h-[320px] hidden md:block">
                <div class="absolute top-[10px] left-0 flex items-center gap-2 bg-gray-900 border border-teal-400/20 text-teal-400 px-4 py-2.5 rounded-xl text-[0.82rem] font-medium whitespace-nowrap shadow-[0_8px_32px_rgba(0,0,0,0.4)] [animation:float_4s_ease-in-out_infinite]">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    PDF Merged ✓
                </div>
                <div class="absolute top-[120px] right-0 flex items-center gap-2 bg-gray-900 border border-amber-400/20 text-amber-400 px-4 py-2.5 rounded-xl text-[0.82rem] font-medium whitespace-nowrap shadow-[0_8px_32px_rgba(0,0,0,0.4)] [animation:float_4s_ease-in-out_infinite] [animation-delay:1s]">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Crypto Update
                </div>
                <div class="absolute bottom-[40px] left-[20px] flex items-center gap-2 bg-gray-900 border border-violet-400/20 text-violet-400 px-4 py-2.5 rounded-xl text-[0.82rem] font-medium whitespace-nowrap shadow-[0_8px_32px_rgba(0,0,0,0.4)] [animation:float_4s_ease-in-out_infinite] [animation-delay:2s]">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Image → PDF
                </div>
            </div>
        </section>

        {{-- Alert Messages --}}
        @if(session('error'))
        <div class="max-w-[900px] mx-auto px-8">
            <div class="flex items-start gap-3 p-3.5 rounded-xl mb-4 text-sm bg-red-500/10 border border-red-500/30 text-red-300">
                <div class="mt-0.5 opacity-70">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold mb-0.5">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="max-w-[900px] mx-auto px-8">
            <div class="flex items-start gap-3 p-3.5 rounded-xl mb-4 text-sm bg-red-500/10 border border-red-500/30 text-red-300">
                <div class="mt-0.5 opacity-70">
                    <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Tools Sections --}}
        <section class="max-w-[1200px] mx-auto px-8 pt-16 pb-24">
            <div class="text-center mb-16 [animation:fadeSlideUp_0.6s_ease_both]">
                <p class="text-[0.78rem] uppercase tracking-[0.12em] text-teal-400 font-semibold mb-2">Pilih Kategori</p>
                <h2 class="font-['Syne',sans-serif] text-[clamp(1.8rem,4vw,2.6rem)] font-extrabold text-white">Semua dalam Satu Tempat</h2>
            </div>

            {{-- 1. PDF TOOLS --}}
            <div class="mb-16 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.1s]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-violet-500/20 flex items-center justify-center text-violet-400 border border-violet-500/20">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-['Syne',sans-serif] text-2xl font-bold text-white">PDF Tools</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Image to PDF --}}
                    <a href="{{ route('tools.imagePdf') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(167,139,250,0.1)] hover:border-violet-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-violet-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-violet-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Image to PDF</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Ubah foto atau gambar menjadi dokumen PDF siap cetak dalam sekejap.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-violet-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>

                    {{-- Merge PDF --}}
                    <a href="{{ route('tools.mergePdf') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(167,139,250,0.1)] hover:border-violet-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-violet-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-violet-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Merge PDF</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Gabungkan beberapa file PDF menjadi satu dokumen yang rapi dan teratur.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-violet-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>
                </div>
            </div>

            {{-- 2. HIBURAN --}}
            <div class="mb-16 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.2s]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-fuchsia-500/20 flex items-center justify-center text-fuchsia-400 border border-fuchsia-500/20">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h3 class="font-['Syne',sans-serif] text-2xl font-bold text-white">Hiburan</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Movies --}}
                    <a href="{{ route('tools.movies-recomendation') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(232,121,249,0.1)] hover:border-fuchsia-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-fuchsia-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-fuchsia-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Movie Finder</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Butuh istirahat? Temukan rekomendasi film terbaik untuk menemani waktu santaimu.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-fuchsia-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>
                </div>
            </div>

            {{-- 3. BERITA CRYPTO --}}
            <div class="mb-16 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.3s]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/20 flex items-center justify-center text-amber-400 border border-amber-500/20">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="font-['Syne',sans-serif] text-2xl font-bold text-white">Berita Saham</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Crypto News (Contoh Dummy Card) --}}
                    <a href="#" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(251,191,36,0.1)] hover:border-amber-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-amber-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-amber-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Crypto Tracker</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Dapatkan update harga pasar secara real-time dan berita terbaru seputar cryptocurrency.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-amber-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>
                </div>
            </div>

            {{-- 4. OLAHRAGA --}}
            <div class="mb-16 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.4s]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 border border-emerald-500/20">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-['Syne',sans-serif] text-2xl font-bold text-white">Olahraga</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Sports News (Contoh Dummy Card) --}}
                    <a href="{{ route('tools.sepakBola') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(52,211,153,0.1)] hover:border-emerald-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-emerald-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-emerald-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Portal Olahraga</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Pantau skor pertandingan langsung, jadwal liga, dan highlight berita olahraga terkini.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-emerald-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>
                </div>
            </div>

            {{-- 5. PERJALANAN --}}
            <div class="mb-16 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.5s]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-rose-500/20 flex items-center justify-center text-rose-400 border border-rose-500/20">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="font-['Syne',sans-serif] text-2xl font-bold text-white">Perjalanan</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Cafe Finder --}}
                    <a href="{{ route('tools.cafeFinder') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(251,113,133,0.1)] hover:border-rose-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-rose-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-rose-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Cafe Finder</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Temukan cafe terdekat yang nyaman untuk nugas, lengkap dengan info lokasi strategis.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-rose-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>
                </div>
            </div>

            {{-- 6. EDUKASI & PRODUKTIVITAS (Tambahan untuk alat lainnya) --}}
            <div class="mb-16 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.6s]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center text-blue-400 border border-blue-500/20">
                        <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="font-['Syne',sans-serif] text-2xl font-bold text-white">Edukasi & Produktivitas</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Pomodoro --}}
                    <a href="{{ route('tools.pomodoro') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(45,212,191,0.1)] hover:border-teal-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-teal-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-teal-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Pomodoro Timer</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Tingkatkan fokus belajarmu dengan sesi kerja terstruktur dan jeda terjadwal.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-teal-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>

                    {{-- Cari Kata --}}
                    <a href="{{ route('tools.cariKata') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(96,165,250,0.1)] hover:border-blue-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-blue-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-blue-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Cari Kata</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Kamus instan untuk mencari makna kata, sinonim, dan antonim untuk tugas menulismu.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-blue-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>

                    {{-- Ai Cleaner --}}
                    <a href="{{ route('tools.noteCleaner') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(56,189,248,0.1)] hover:border-sky-400/30">
                        <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-sky-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>
                        <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-sky-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                            <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h4 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Ai Note Cleaner</h4>
                        <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Bersihkan, ringkas, dan rapikan catatan belajarmu secara otomatis dengan bantuan AI.</p>
                        <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-sky-400 transition-all duration-200 group-hover:gap-2.5">
                            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            Mulai Sekarang
                        </div>
                    </a>
                </div>
            </div>

        </section>

        {{-- Footer CTA --}}
        <section class="py-16 px-8 text-center">
            <div class="max-w-[600px] mx-auto py-12 px-8 bg-gradient-to-br from-teal-400/5 to-violet-400/5 border border-white/10 rounded-[24px]">
                <h2 class="font-['Syne',sans-serif] text-[clamp(1.5rem,3vw,2rem)] font-extrabold text-white mb-3">Siap meningkatkan produktivitasmu?</h2>
                <p class="text-[0.95rem] text-slate-500 leading-[1.6]">Pilih tool di atas dan mulai sekarang — tanpa login, tanpa biaya.</p>
            </div>
        </section>
    </div>

</x-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap');

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
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