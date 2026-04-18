<x-layout title="Home - PDF Planet">
    <x-navbar />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap');

        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
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

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen">

        {{-- Hero Section --}}
        <section class="relative min-h-[88vh] flex flex-col md:flex-row items-center justify-between gap-12 max-w-[1200px] mx-auto px-8 pt-24 pb-16 overflow-hidden">
            <div class="absolute top-[-120px] left-[-100px] w-[700px] h-[700px] bg-[radial-gradient(circle,rgba(45,212,191,0.12)_0%,transparent_65%)] pointer-events-none z-0"></div>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.025)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.025)_1px,transparent_1px)] bg-[size:60px_60px] pointer-events-none [mask-image:radial-gradient(ellipse_80%_80%_at_50%_50%,black_30%,transparent_100%)] z-0"></div>

            <div class="relative z-10 flex-1 max-w-[560px]">
                <div class="inline-flex items-center gap-2 bg-teal-400/10 border border-teal-400/25 text-teal-400 text-sm font-medium px-3.5 py-1.5 rounded-full mb-6 tracking-wide">
                    <span class="w-[7px] h-[7px] bg-teal-400 rounded-full shadow-[0_0_8px_#2dd4bf] animate-pulse"></span>
                    100% Gratis · Tanpa Daftar
                </div>

                <h1 class="font-['Syne',sans-serif] text-[clamp(2rem,6vw,5rem)] font-extrabold leading-[1.05] mb-5 text-white">
                    Effortless
                    <span class="[-webkit-text-stroke:2px_#2dd4bf] text-transparent block">Student<br>Tools</span>
                    You Can Use
                </h1>

                <p class="text-[1.05rem] text-slate-500 leading-relaxed mb-10 font-light">
                    Semua alat favorit kamu di satu tempat — dari PDF, hiburan, hingga berita crypto.
                    Cepat, terstruktur, dan mudah digunakan.
                </p>

                <div class="flex items-center gap-6">
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
        <div class="max-w-[1200px] mx-auto px-8">
            <div class="flex items-start gap-3 p-3.5 rounded-xl mb-4 text-sm bg-red-500/10 border border-red-500/30 text-red-300">
                <svg class="mt-0.5 opacity-70 shrink-0" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="font-semibold mb-0.5">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if($errors->any())
        <div class="max-w-[1200px] mx-auto px-8">
            <div class="flex items-start gap-3 p-3.5 rounded-xl mb-4 text-sm bg-red-500/10 border border-red-500/30 text-red-300">
                <svg class="mt-0.5 opacity-70 shrink-0" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <ul class="list-disc pl-4">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        </div>
        @endif

        {{-- Tools Sections --}}
        <section class="max-w-[1200px] mx-auto px-8 pt-10 pb-24">

            <div class="text-center mb-12">
                <p class="text-[0.78rem] uppercase tracking-[0.12em] text-teal-400 font-semibold mb-2">Pilih Kategori</p>
                <h2 class="font-['Syne',sans-serif] text-[clamp(1.8rem,4vw,2.6rem)] font-extrabold text-white">Semua dalam Satu Tempat</h2>
            </div>

            {{-- ── Reusable tool-card style ── --}}
            <style>
                .tool-section {
                    margin-bottom: 2rem;
                }

                .tool-section-head {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    margin-bottom: 0.875rem;
                    padding-bottom: 0.75rem;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.07);
                }

                .tool-section-icon {
                    width: 30px;
                    height: 30px;
                    border-radius: 9px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                }

                .tool-section-label {
                    font-family: 'Syne', sans-serif;
                    font-size: 1rem;
                    font-weight: 700;
                    color: #fff;
                }

                .tool-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
                    gap: 10px;
                }

                .tool-card {
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    padding: 11px 14px;
                    background: #0e1520;
                    border: 1px solid #1e2d45;
                    border-radius: 13px;
                    text-decoration: none;
                    color: #e2e8f0;
                    transition: background 0.2s, border-color 0.2s;
                }

                .tool-card:hover {
                    background: #131b2a;
                }

                .tool-card-icon {
                    width: 34px;
                    height: 34px;
                    border-radius: 9px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-shrink: 0;
                    background: rgba(255, 255, 255, 0.04);
                }

                .tool-card-body {
                    flex: 1;
                    min-width: 0;
                }

                .tool-card-title {
                    font-size: 0.84rem;
                    font-weight: 500;
                    color: #fff;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .tool-card-desc {
                    font-size: 0.71rem;
                    color: #64748b;
                    line-height: 1.4;
                    margin-top: 2px;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }

                .tool-card-arrow {
                    flex-shrink: 0;
                    color: #334155;
                }
            </style>

            {{-- 1. PDF Tools --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-violet-500/15 border border-violet-500/20 text-violet-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="tool-section-label">PDF Tools</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.imagePdf') }}" class="tool-card hover:border-violet-500/30">
                        <div class="tool-card-icon text-violet-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Image to PDF</div>
                            <div class="tool-card-desc">Ubah gambar menjadi PDF siap cetak</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                    <a href="{{ route('tools.mergePdf') }}" class="tool-card hover:border-violet-500/30">
                        <div class="tool-card-icon text-violet-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Merge PDF</div>
                            <div class="tool-card-desc">Gabungkan beberapa file PDF menjadi satu</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

            {{-- 2. Hiburan --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-fuchsia-500/15 border border-fuchsia-500/20 text-fuchsia-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <span class="tool-section-label">Hiburan</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.movies-recomendation') }}" class="tool-card hover:border-fuchsia-500/30">
                        <div class="tool-card-icon text-fuchsia-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Movie Finder</div>
                            <div class="tool-card-desc">Temukan rekomendasi film terbaik</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

            {{-- 3. Berita Saham --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-amber-500/15 border border-amber-500/20 text-amber-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <span class="tool-section-label">Berita Saham</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.cryptoTracker') }}" class="tool-card hover:border-amber-500/30">
                        <div class="tool-card-icon text-amber-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Crypto Tracker</div>
                            <div class="tool-card-desc">Harga crypto real-time & berita terbaru</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                    <a href="{{ route('tools.goldCheck') }}" class="tool-card hover:border-amber-500/30">
                        <div class="tool-card-icon text-amber-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Gold Check</div>
                            <div class="tool-card-desc">Pantau harga emas terkini</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

            {{-- 4. Olahraga --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-emerald-500/15 border border-emerald-500/20 text-emerald-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                    <span class="tool-section-label">Olahraga</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.sepakBola') }}" class="tool-card hover:border-emerald-500/30">
                        <div class="tool-card-icon text-emerald-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Sepak Bola</div>
                            <div class="tool-card-desc">Skor live, jadwal, & berita olahraga</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

            {{-- 5. Perjalanan --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-rose-500/15 border border-rose-500/20 text-rose-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="tool-section-label">Perjalanan</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.cafeFinder') }}" class="tool-card hover:border-rose-500/30">
                        <div class="tool-card-icon text-rose-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Cafe Finder</div>
                            <div class="tool-card-desc">Cafe terdekat untuk nugas & santai</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

            {{-- 6. Informasi BMKG --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-blue-500/15 border border-blue-500/20 text-blue-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="tool-section-label">Informasi BMKG</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.weather') }}" class="tool-card hover:border-sky-500/30">
                        <div class="tool-card-icon text-sky-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 110-8 4 4 0 017.5 0A4.5 4.5 0 1111 15H3z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Prakiraan Cuaca</div>
                            <div class="tool-card-desc">Cuaca & angin real-time dari BMKG</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                    <a href="{{ route('tools.gempa') }}" class="tool-card hover:border-amber-500/30">
                        <div class="tool-card-icon text-amber-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Gempa Bumi</div>
                            <div class="tool-card-desc">Magnitudo & lokasi gempa terkini</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

            {{-- 7. Edukasi & Produktivitas --}}
            <div class="tool-section">
                <div class="tool-section-head">
                    <div class="tool-section-icon bg-teal-500/15 border border-teal-500/20 text-teal-400">
                        <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <span class="tool-section-label">Edukasi & Produktivitas</span>
                </div>
                <div class="tool-grid">
                    <a href="{{ route('tools.pomodoro') }}" class="tool-card hover:border-teal-500/30">
                        <div class="tool-card-icon text-teal-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Pomodoro Timer</div>
                            <div class="tool-card-desc">Sesi belajar terstruktur & terfokus</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                    <a href="{{ route('tools.cariKata') }}" class="tool-card hover:border-blue-500/30">
                        <div class="tool-card-icon text-blue-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">Cari Kata</div>
                            <div class="tool-card-desc">Kamus sinonim & antonim instan</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                    <a href="{{ route('tools.noteCleaner') }}" class="tool-card hover:border-sky-500/30">
                        <div class="tool-card-icon text-sky-400"><svg width="17" height="17" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg></div>
                        <div class="tool-card-body">
                            <div class="tool-card-title">AI Note Cleaner</div>
                            <div class="tool-card-desc">Rapikan catatan dengan bantuan AI</div>
                        </div>
                        <div class="tool-card-arrow"><svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg></div>
                    </a>
                </div>
            </div>

        </section>

        {{-- Footer CTA --}}
        <section class="py-12 px-8 text-center">
            <div class="max-w-[560px] mx-auto py-10 px-8 bg-gradient-to-br from-teal-400/5 to-violet-400/5 border border-white/10 rounded-[20px]">
                <h2 class="font-['Syne',sans-serif] text-[clamp(1.4rem,3vw,1.9rem)] font-extrabold text-white mb-3">Siap meningkatkan produktivitasmu?</h2>
                <p class="text-[0.9rem] text-slate-500 leading-[1.6]">Pilih tool di atas dan mulai sekarang — tanpa login, tanpa biaya.</p>
            </div>
        </section>

    </div>

</x-layout>