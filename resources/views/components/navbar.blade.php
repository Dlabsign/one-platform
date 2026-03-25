<nav class="sticky top-0 z-50 w-full backdrop-blur-md bg-[#0b0f1a]/80 border-b border-white/10 font-['DM_Sans',sans-serif]">
    <div class="max-w-[1200px] mx-auto px-6 md:px-8 py-4 flex justify-between items-center">

        {{-- Logo & Brand --}}
        <a href="/" class="flex items-center gap-2 group">
            <div class="w-8 h-8 rounded-xl bg-teal-400/10 text-teal-400 border border-teal-400/20 flex items-center justify-center transition-all duration-300 group-hover:bg-teal-400 group-hover:text-gray-900 group-hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <span class="font-['Syne',sans-serif] font-extrabold text-xl text-white tracking-wide">
                Created By<span class="text-teal-400"> Dlabsign</span>
            </span>
        </a>

        {{-- Navigation Links --}}
        <div class="flex items-center gap-6 md:gap-8">
            <a href="/" class="text-sm font-medium text-slate-300 hover:text-teal-400 transition-colors">Home</a>
            {{-- Tombol opsional (bisa dihapus kalau tidak perlu) --}}
            <a href="/" class="hidden md:inline-flex items-center justify-center text-sm font-bold bg-white/5 hover:bg-white/10 text-white px-5 py-2 rounded-full border border-white/10 transition-colors">
                Explore Tools
            </a>
        </div>

    </div>
</nav>