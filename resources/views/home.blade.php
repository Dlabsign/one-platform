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
                    Semua alat favorit kamu di satu tempat — dari PDF hingga produktivitas.
                    <br>Cepat, gratis, dan mudah digunakan.
                </p>

                <div class="flex items-center gap-6 [animation:fadeSlideUp_0.6s_0.3s_ease_both]">
                    <div class="text-center">
                        <span class="block font-['Syne',sans-serif] text-[1.6rem] font-extrabold text-white">3+</span>
                        <span class="text-xs text-slate-500">Tools</span>
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
                    Focus: 25:00
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

        {{-- Tools Section --}}
        <section class="max-w-[1200px] mx-auto px-8 pt-16 pb-24">
            <div class="text-center mb-12 [animation:fadeSlideUp_0.6s_ease_both]">
                <p class="text-[0.78rem] uppercase tracking-[0.12em] text-teal-400 font-semibold mb-2">Pilih Alatmu</p>
                <h2 class="font-['Syne',sans-serif] text-[clamp(1.8rem,4vw,2.6rem)] font-extrabold text-white">Semua dalam Satu Tempat</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Pomodoro --}}
                <a href="{{ route('tools.pomodoro') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(45,212,191,0.1)] hover:border-teal-400/30 [animation:fadeSlideUp_0.6s_ease_both]">
                    <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-teal-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>

                    <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-teal-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div class="text-[0.7rem] uppercase tracking-[0.1em] text-teal-400 font-semibold mb-1.5">Produktivitas</div>
                    <h3 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Pomodoro Timer</h3>
                    <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Tingkatkan fokus belajarmu dengan sesi kerja terstruktur dan jeda terjadwal.</p>

                    <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-teal-400 transition-all duration-200 group-hover:gap-2.5">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                        Mulai Sekarang
                    </div>
                </a>

                {{-- Image to PDF --}}
                <a href="{{ route('tools.imagePdf') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(251,191,36,0.1)] hover:border-amber-400/30 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.1s]">
                    <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-amber-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>

                    <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-amber-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <div class="text-[0.7rem] uppercase tracking-[0.1em] text-amber-400 font-semibold mb-1.5">Konversi</div>
                    <h3 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Image to PDF</h3>
                    <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Ubah foto atau gambar menjadi dokumen PDF siap cetak dalam sekejap.</p>

                    <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-amber-400 transition-all duration-200 group-hover:gap-2.5">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                        Mulai Sekarang
                    </div>
                </a>

                {{-- Merge PDF --}}
                <a href="{{ route('tools.mergePdf') }}" class="group relative flex flex-col p-8 rounded-[18px] bg-gray-900 border border-white/10 text-slate-100 overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_60px_rgba(167,139,250,0.1)] hover:border-violet-400/30 [animation:fadeSlideUp_0.6s_ease_both] [animation-delay:0.2s]">
                    <div class="absolute -top-[60px] -right-[60px] w-[200px] h-[200px] rounded-full bg-violet-400 opacity-10 transition-all duration-300 pointer-events-none group-hover:opacity-15 group-hover:scale-125"></div>

                    <div class="w-[52px] h-[52px] rounded-2xl flex items-center justify-center bg-white/5 text-violet-400 mb-5 transition-colors duration-300 group-hover:bg-white/10">
                        <svg width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                        </svg>
                    </div>

                    <div class="text-[0.7rem] uppercase tracking-[0.1em] text-violet-400 font-semibold mb-1.5">PDF</div>
                    <h3 class="font-['Syne',sans-serif] text-[1.3rem] font-bold mb-2.5 text-white">Merge PDF</h3>
                    <p class="text-[0.88rem] text-slate-500 leading-[1.65] flex-1 mb-6">Gabungkan beberapa file PDF menjadi satu dokumen yang rapi dan teratur.</p>

                    <div class="flex items-center gap-1.5 text-[0.82rem] font-medium text-violet-400 transition-all duration-200 group-hover:gap-2.5">
                        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                        Mulai Sekarang
                    </div>
                </a>

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

{{-- Sisa style untuk Font & Keyframes khusus saja --}}
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