<x-layout title="Rekomendasi Film - PDF Planet">
    <x-navbar />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

        .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); border-radius: 8px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: rgba(217, 70, 239, 0.3); border-radius: 8px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(217, 70, 239, 0.6); }

        @keyframes fadeSlideUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        
        .modal-enter { animation: fadeIn 0.3s ease-out forwards; }
        .modal-content-enter { animation: fadeSlideUp 0.4s ease-out forwards; }
    </style>

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-8 pb-20">
        <div class="max-w-[1400px] mx-auto px-4 md:px-8">

            {{-- HEADER & SEARCH --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="inline-flex items-center gap-2 bg-fuchsia-500/10 border border-fuchsia-500/25 text-fuchsia-400 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path></svg>
                    Powered by TMDB
                </div>
                <h1 class="text-[clamp(2rem,5vw,3.5rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Movie <span class="text-fuchsia-400">Recommendations</span></h1>
                <p class="text-slate-400 font-light text-lg mb-8">Temukan film terbaik, cek platform streaming, dan lihat pemerannya.</p>

                {{-- Search Bar --}}
                <div class="max-w-2xl mx-auto">
                    <form id="searchForm" class="flex bg-gray-900/80 backdrop-blur-md rounded-2xl overflow-hidden border border-white/10 shadow-2xl focus-within:border-fuchsia-500/50 transition-colors">
                        <input type="text" id="searchInput" placeholder="Cari judul film (contoh: Inception)..." class="flex-1 bg-transparent px-6 py-4 focus:outline-none text-slate-200 text-lg placeholder-slate-500">
                        <button type="submit" class="bg-fuchsia-600 hover:bg-fuchsia-500 text-white px-8 py-4 font-bold transition flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="hidden md:inline">Cari</span>
                        </button>
                    </form>
                </div>
            </div>

            {{-- FILTER TIPE AKSES (GRATIS / BERBAYAR) --}}
            <div class="mb-4 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                <div class="flex items-center gap-3 overflow-x-auto pb-2 custom-scroll" id="monetizationContainer">
                    <span class="text-slate-400 text-sm font-bold mr-2 shrink-0">Akses Tonton:</span>
                    <button class="monetize-btn active shrink-0 px-4 py-1.5 rounded-full border border-fuchsia-500 bg-fuchsia-500 text-white font-semibold text-sm transition" data-val="all">Semua</button>
                    <button class="monetize-btn shrink-0 px-4 py-1.5 rounded-full border border-white/10 bg-gray-800/50 text-slate-300 hover:border-fuchsia-500/50 hover:text-white font-semibold text-sm transition flex items-center gap-1.5" data-val="free">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Gratis (Free)
                    </button>
                    <button class="monetize-btn shrink-0 px-4 py-1.5 rounded-full border border-white/10 bg-gray-800/50 text-slate-300 hover:border-fuchsia-500/50 hover:text-white font-semibold text-sm transition flex items-center gap-1.5" data-val="paid">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg> Berbayar / Streaming
                    </button>
                </div>
            </div>

            {{-- KATEGORI (GENRE) FILTER --}}
            <div class="mb-8 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                <div class="flex items-center gap-3 overflow-x-auto pb-4 custom-scroll" id="genreContainer">
                    <span class="text-slate-400 text-sm font-bold mr-2 shrink-0">Kategori:</span>
                    <button class="genre-btn active shrink-0 px-5 py-2 rounded-full border border-fuchsia-500 bg-fuchsia-500 text-white font-semibold text-sm transition" data-id="all">Semua Kategori</button>
                    {{-- Genre akan di-generate JS di sini --}}
                </div>
            </div>

            {{-- TITLE SECTION --}}
            <div class="flex items-center justify-between mb-6 [animation:fadeSlideUp_0.6s_0.2s_ease_both]">
                <h2 id="sectionTitle" class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3 scroll-mt-24">
                    <span class="w-2 h-8 bg-fuchsia-500 rounded-full"></span>
                    Film Terpopuler Saat Ini
                </h2>
            </div>

            {{-- MOVIE GRID --}}
            <div id="movieGrid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6 [animation:fadeSlideUp_0.6s_0.3s_ease_both]">
                {{-- Loading State --}}
                <div class="col-span-full text-center py-20" id="loadingState">
                    <div class="w-12 h-12 border-4 border-fuchsia-500/20 border-t-fuchsia-500 rounded-full animate-spin mx-auto mb-4"></div>
                    <p class="text-fuchsia-400 font-bold font-['Syne',sans-serif] animate-pulse">Memuat film...</p>
                </div>
            </div>

            {{-- PAGINATION CONTAINER --}}
            <div id="paginationContainer" class="flex justify-center items-center gap-2 mt-12 hidden [animation:fadeSlideUp_0.6s_0.4s_ease_both]">
                {{-- Tombol navigasi halaman akan diisi oleh JS --}}
            </div>

        </div>
    </div>

    {{-- MODAL DETAIL FILM --}}
    <div id="movieModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6">
        {{-- Overlay Hitam --}}
        <div class="absolute inset-0 bg-[#0b0f1a]/90 backdrop-blur-sm" id="modalOverlay"></div>
        
        {{-- Konten Modal --}}
        <div class="relative w-full max-w-5xl bg-gray-900/95 border border-white/10 rounded-[28px] shadow-2xl overflow-hidden flex flex-col max-h-[90vh] modal-content-enter">
            
            {{-- Tombol Close --}}
            <button id="closeModalBtn" class="absolute top-4 right-4 z-10 bg-black/50 hover:bg-fuchsia-600 text-white w-10 h-10 rounded-full flex items-center justify-center backdrop-blur-md transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="flex flex-col md:flex-row overflow-y-auto custom-scroll h-full">
                {{-- Kiri: Poster --}}
                <div class="w-full md:w-1/3 lg:w-1/4 shrink-0 bg-black/50">
                    <img id="modalPoster" src="" alt="Poster" class="w-full h-auto md:h-full object-cover object-top aspect-[2/3]">
                </div>
                
                {{-- Kanan: Detail --}}
                <div class="p-6 md:p-8 flex-1 flex flex-col min-w-0">
                    <h2 id="modalTitle" class="text-3xl md:text-4xl font-black font-['Syne',sans-serif] text-white mb-2 leading-tight">Judul Film</h2>

                    <div class="flex flex-wrap items-center gap-3 text-sm font-medium mb-5">
                        <span id="modalDate" class="text-slate-300 bg-white/5 px-3 py-1 rounded-lg border border-white/5">2023</span>
                        <div class="flex items-center gap-1 text-amber-400 bg-amber-400/10 px-3 py-1 rounded-lg border border-amber-400/20">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                            </svg>
                            <span id="modalRating">8.5</span>
                        </div>
                        <span id="modalGenres" class="text-fuchsia-300">Action, Adventure</span>
                    </div>

                    {{-- STREAMING PROVIDERS --}}
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider mb-2">Platform Streaming (Indonesia)</h3>
                    <div id="modalProviders" class="flex flex-wrap gap-2 mb-6">
                        {{-- Logo streaming (Netflix dll) akan dimuat di sini --}}
                    </div>

                    <h3 class="text-lg font-bold text-white font-['Syne',sans-serif] mb-2">Sinopsis</h3>
                    <p id="modalOverview" class="text-slate-400 leading-relaxed mb-6 font-light">Deskripsi film akan muncul di sini...</p>

                    <h3 class="text-lg font-bold text-white font-['Syne',sans-serif] mb-3">Cast</h3>
                    <div id="modalCast" class="flex gap-4 overflow-x-auto custom-scroll pb-4 snap-x max-w-full">
                        {{-- Cast Muat di sini --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // API Setup
            const API_KEY = '1b186cb69effd8e30c1a45dd7377a29e';
            const BASE_URL = 'https://api.themoviedb.org/3';
            const IMG_URL = 'https://image.tmdb.org/t/p/w500';
            const IMG_URL_LARGE = 'https://image.tmdb.org/t/p/w780'; 

            const movieGrid = document.getElementById('movieGrid');
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');
            const sectionTitle = document.getElementById('sectionTitle');
            const loadingState = document.getElementById('loadingState');
            const genreContainer = document.getElementById('genreContainer');
            const paginationContainer = document.getElementById('paginationContainer');
            
            const movieModal = document.getElementById('movieModal');
            const modalOverlay = document.getElementById('modalOverlay');
            const closeModalBtn = document.getElementById('closeModalBtn');

            // STATE VARIABLES
            let currentMode = 'discover'; 
            let currentQuery = '';
            let currentGenreId = 'all';
            let currentMonetize = 'all'; // 'all', 'free', 'paid'
            let currentPage = 1;
            let totalPages = 1;

            // 1. Fetch & Render Kategori (Genre)
            async function getGenres() {
                try {
                    const res = await fetch(`${BASE_URL}/genre/movie/list?api_key=${API_KEY}&language=id-ID`);
                    const data = await res.json();
                    
                    data.genres.forEach(genre => {
                        const btn = document.createElement('button');
                        btn.className = 'genre-btn shrink-0 px-5 py-2 rounded-full border border-white/10 bg-gray-800/50 text-slate-300 hover:border-fuchsia-500/50 hover:text-white font-semibold text-sm transition';
                        btn.textContent = genre.name;
                        btn.dataset.id = genre.id;
                        
                        btn.addEventListener('click', () => {
                            document.querySelectorAll('.genre-btn').forEach(b => {
                                b.className = 'genre-btn shrink-0 px-5 py-2 rounded-full border border-white/10 bg-gray-800/50 text-slate-300 hover:border-fuchsia-500/50 hover:text-white font-semibold text-sm transition';
                            });
                            btn.className = 'genre-btn active shrink-0 px-5 py-2 rounded-full border border-fuchsia-500 bg-fuchsia-500 text-white font-semibold text-sm transition';
                            
                            currentGenreId = genre.id;
                            searchInput.value = ''; 
                            updateTitle();
                            discoverMovies(1);
                        });

                        genreContainer.appendChild(btn);
                    });
                } catch (error) {
                    console.error("Gagal load genre", error);
                }
            }

            // 2. Filter Akses (Gratis / Berbayar)
            document.querySelectorAll('.monetize-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.monetize-btn').forEach(b => {
                        b.classList.remove('active', 'border-fuchsia-500', 'bg-fuchsia-500', 'text-white');
                        b.classList.add('border-white/10', 'bg-gray-800/50', 'text-slate-300');
                    });
                    btn.classList.remove('border-white/10', 'bg-gray-800/50', 'text-slate-300');
                    btn.classList.add('active', 'border-fuchsia-500', 'bg-fuchsia-500', 'text-white');
                    
                    currentMonetize = btn.dataset.val;
                    searchInput.value = ''; // Reset pencarian jika menggunakan filter akses
                    updateTitle();
                    discoverMovies(1);
                });
            });

            function updateTitle() {
                let text = "Film Terpopuler Saat Ini";
                if(currentMonetize === 'free') text = "Film Gratis (Free to Watch)";
                if(currentMonetize === 'paid') text = "Film Berbayar / Streaming Premium";
                
                const activeGenre = document.querySelector('.genre-btn.active').textContent;
                if(currentGenreId !== 'all') text += ` - Kategori: ${activeGenre}`;

                sectionTitle.innerHTML = `<span class="w-2 h-8 bg-fuchsia-500 rounded-full"></span> ${text}`;
            }

            // 3. Routing Pengambilan Data Berdasarkan Mode
            function discoverMovies(page = 1) {
                currentMode = 'discover';
                currentPage = page;
                
                let url = `${BASE_URL}/discover/movie?api_key=${API_KEY}&language=id-ID&page=${page}&sort_by=popularity.desc&watch_region=ID`;
                
                if (currentGenreId !== 'all') url += `&with_genres=${currentGenreId}`;
                
                // Tambahkan filter monetisasi (Gratis / Berbayar)
                if (currentMonetize === 'free') {
                    url += `&with_watch_monetization_types=free|ads`;
                } else if (currentMonetize === 'paid') {
                    url += `&with_watch_monetization_types=flatrate|rent|buy`;
                }

                fetchMovies(url);
            }

            function searchMovies(query, page = 1) {
                currentMode = 'search';
                currentQuery = query;
                currentPage = page;
                fetchMovies(`${BASE_URL}/search/movie?api_key=${API_KEY}&language=id-ID&query=${query}&page=${page}`);
            }

            // 4. Main Fetch Function
            function fetchMovies(url) {
                movieGrid.innerHTML = ''; 
                movieGrid.appendChild(loadingState);
                loadingState.classList.remove('hidden');
                paginationContainer.classList.add('hidden');

                fetch(url)
                    .then(res => res.json())
                    .then(data => {
                        loadingState.classList.add('hidden');
                        totalPages = data.total_pages > 500 ? 500 : data.total_pages; 
                        showMovies(data.results);
                        renderPagination(currentPage, totalPages);
                    })
                    .catch(error => {
                        loadingState.classList.add('hidden');
                        movieGrid.innerHTML = `<div class="col-span-full text-center py-10 text-red-400 font-bold">Gagal memuat data.</div>`;
                    });
            }

            // 5. Render Movie Grid
            function showMovies(data) {
                movieGrid.innerHTML = ''; 

                if (data.length === 0) {
                    movieGrid.innerHTML = `<div class="col-span-full text-center py-16 text-slate-500 text-lg">Tidak ada film yang sesuai dengan filter ini.</div>`;
                    return;
                }

                data.forEach(movie => {
                    const { id, title, poster_path, vote_average, release_date } = movie;
                    if (!poster_path) return;

                    const year = release_date ? release_date.split('-')[0] : 'N/A';
                    const movieEl = document.createElement('div');
                    movieEl.className = 'bg-gray-800/40 rounded-[20px] border border-white/5 overflow-hidden hover:border-fuchsia-500/50 hover:shadow-[0_0_30px_rgba(217,70,239,0.15)] transition-all duration-300 transform hover:-translate-y-1.5 cursor-pointer group';
                    movieEl.onclick = () => openModal(id);

                    movieEl.innerHTML = `
                        <div class="relative aspect-[2/3] overflow-hidden">
                            <img src="${IMG_URL + poster_path}" alt="${title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute top-3 right-3 bg-[#0b0f1a]/80 text-amber-400 font-bold px-2.5 py-1 rounded-lg text-xs flex items-center backdrop-blur-md border border-white/10">
                                <svg class="w-3 h-3 mr-1 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                ${vote_average.toFixed(1)}
                            </div>
                        </div>
                        <div class="p-4 relative z-10 -mt-8 bg-gradient-to-t from-[#0b0f1a] via-[#0b0f1a]/90 to-transparent">
                            <h3 class="font-bold text-white text-base line-clamp-1 group-hover:text-fuchsia-400 transition font-['Syne',sans-serif] pt-4">${title}</h3>
                            <p class="text-xs text-slate-400 mt-1">${year}</p>
                        </div>
                    `;
                    movieGrid.appendChild(movieEl);
                });
            }

            // 6. Pagination
            function renderPagination(page, total) {
                paginationContainer.innerHTML = '';
                if (total <= 1) return;
                
                paginationContainer.classList.remove('hidden');

                const prevBtn = document.createElement('button');
                prevBtn.className = `px-4 py-2 rounded-xl font-bold transition flex items-center gap-1 ${page === 1 ? 'bg-gray-800 border border-white/5 text-slate-600 cursor-not-allowed' : 'bg-gray-800 border border-white/10 hover:bg-fuchsia-600 hover:text-white text-slate-300'}`;
                prevBtn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg> Prev`;
                prevBtn.disabled = page === 1;
                prevBtn.onclick = () => loadPage(page - 1);
                paginationContainer.appendChild(prevBtn);

                let startPage = Math.max(1, page - 2);
                let endPage = Math.min(total, page + 2);

                if (page <= 2) endPage = Math.min(total, 5);
                if (page >= total - 1) startPage = Math.max(1, total - 4);

                for (let i = startPage; i <= endPage; i++) {
                    const pageBtn = document.createElement('button');
                    pageBtn.className = `w-10 h-10 flex items-center justify-center rounded-xl font-bold transition ${i === page ? 'bg-fuchsia-500 text-white shadow-[0_0_15px_rgba(217,70,239,0.4)]' : 'bg-gray-800 border border-white/10 text-slate-300 hover:bg-fuchsia-500/50 hover:text-white'}`;
                    pageBtn.textContent = i;
                    pageBtn.onclick = () => loadPage(i);
                    paginationContainer.appendChild(pageBtn);
                }

                const nextBtn = document.createElement('button');
                nextBtn.className = `px-4 py-2 rounded-xl font-bold transition flex items-center gap-1 ${page === total ? 'bg-gray-800 border border-white/5 text-slate-600 cursor-not-allowed' : 'bg-gray-800 border border-white/10 hover:bg-fuchsia-600 hover:text-white text-slate-300'}`;
                nextBtn.innerHTML = `Next <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>`;
                nextBtn.disabled = page === total;
                nextBtn.onclick = () => loadPage(page + 1);
                paginationContainer.appendChild(nextBtn);
            }

            function loadPage(pageNumber) {
                if (currentMode === 'discover') {
                    discoverMovies(pageNumber);
                } else if (currentMode === 'search') {
                    searchMovies(currentQuery, pageNumber);
                }
                document.getElementById('sectionTitle').scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            // 7. Modal Detail & Streaming Providers
            async function openModal(movieId) {
                document.getElementById('modalTitle').textContent = 'Memuat...';
                document.getElementById('modalOverview').textContent = '...';
                document.getElementById('modalCast').innerHTML = '';
                document.getElementById('modalPoster').src = '';
                
                const providersContainer = document.getElementById('modalProviders');
                providersContainer.innerHTML = '<span class="text-sm text-slate-500">Mengecek platform streaming...</span>';

                movieModal.classList.remove('hidden');
                movieModal.classList.add('flex', 'modal-enter');
                document.body.style.overflow = 'hidden'; 

                try {
                    // Fetch data detail + credits + watch providers sekaligus
                    const res = await fetch(`${BASE_URL}/movie/${movieId}?api_key=${API_KEY}&language=id-ID&append_to_response=credits,watch/providers`);
                    const data = await res.json();

                    document.getElementById('modalTitle').textContent = data.title;
                    document.getElementById('modalOverview').textContent = data.overview || 'Sinopsis belum tersedia dalam bahasa Indonesia.';
                    document.getElementById('modalDate').textContent = data.release_date ? data.release_date : 'N/A';
                    document.getElementById('modalRating').textContent = data.vote_average.toFixed(1);
                    document.getElementById('modalGenres').textContent = data.genres.map(g => g.name).join(' • ');
                    
                    if(data.poster_path) document.getElementById('modalPoster').src = IMG_URL_LARGE + data.poster_path;

                    // TAMPILKAN PLATFORM STREAMING (Netflix, Disney, dll) di Indonesia
                    providersContainer.innerHTML = '';
                    const idProviders = data['watch/providers']?.results?.ID; // Cek data wilayah "ID"
                    
                    if (idProviders && (idProviders.flatrate || idProviders.free || idProviders.rent || idProviders.buy)) {
                        // Gabungkan semua jenis platform, hapus duplikat jika ada
                        const allProv = [...(idProviders.flatrate || []), ...(idProviders.free || []), ...(idProviders.rent || []), ...(idProviders.buy || [])];
                        const uniqueProv = Array.from(new Set(allProv.map(p => p.provider_id))).map(id => allProv.find(p => p.provider_id === id));
                        
                        uniqueProv.forEach(p => {
                            const provEl = document.createElement('div');
                            provEl.className = 'flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-1.5 rounded-xl';
                            provEl.innerHTML = `
                                <img src="${IMG_URL + p.logo_path}" alt="${p.provider_name}" class="w-6 h-6 rounded-md">
                                <span class="text-xs text-slate-300 font-semibold">${p.provider_name}</span>
                            `;
                            providersContainer.appendChild(provEl);
                        });
                    } else {
                        providersContainer.innerHTML = '<p class="text-sm text-slate-500 italic">Informasi streaming di Indonesia belum tersedia untuk film ini.</p>';
                    }

                    // Tampilkan Cast 
                    const castContainer = document.getElementById('modalCast');
                    const casts = data.credits.cast.slice(0, 10);
                    if(casts.length > 0) {
                        casts.forEach(actor => {
                            const imgProfile = actor.profile_path ? IMG_URL + actor.profile_path : 'https://via.placeholder.com/150x225?text=No+Image';
                            const castEl = document.createElement('div');
                            castEl.className = 'w-24 shrink-0 snap-center text-center';
                            castEl.innerHTML = `
                                <img src="${imgProfile}" alt="${actor.name}" class="w-16 h-16 rounded-full object-cover mx-auto mb-2 border-2 border-white/10">
                                <p class="text-xs text-white font-bold leading-tight line-clamp-1">${actor.name}</p>
                                <p class="text-[10px] text-slate-500 line-clamp-1">${actor.character}</p>
                            `;
                            castContainer.appendChild(castEl);
                        });
                    } else {
                        castContainer.innerHTML = '<p class="text-sm text-slate-500">Data pemeran tidak tersedia.</p>';
                    }

                } catch (error) {
                    console.error("Gagal load detail film", error);
                    document.getElementById('modalOverview').textContent = 'Terjadi kesalahan saat memuat data.';
                    providersContainer.innerHTML = '';
                }
            }

            function closeModal() {
                movieModal.classList.add('hidden');
                movieModal.classList.remove('flex', 'modal-enter');
                document.body.style.overflow = 'auto'; 
            }

            closeModalBtn.addEventListener('click', closeModal);
            modalOverlay.addEventListener('click', closeModal);

            // 8. Event Submit Pencarian Text
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const searchTerm = searchInput.value.trim();

                // Reset filter monetisasi ke 'Semua' karena mode Search TMDB tidak support filter jenis
                document.querySelectorAll('.monetize-btn').forEach(b => {
                    b.classList.remove('active', 'border-fuchsia-500', 'bg-fuchsia-500', 'text-white');
                    b.classList.add('border-white/10', 'bg-gray-800/50', 'text-slate-300');
                });
                document.querySelector('.monetize-btn[data-val="all"]').classList.remove('border-white/10', 'bg-gray-800/50', 'text-slate-300');
                document.querySelector('.monetize-btn[data-val="all"]').classList.add('active', 'border-fuchsia-500', 'bg-fuchsia-500', 'text-white');
                currentMonetize = 'all';

                if (searchTerm) {
                    sectionTitle.innerHTML = `<span class="w-2 h-8 bg-fuchsia-500 rounded-full"></span> Hasil Pencarian: <span class="text-fuchsia-400 ml-2">"${searchTerm}"</span>`;
                    searchMovies(searchTerm, 1);
                } else {
                    updateTitle();
                    discoverMovies(1);
                }
            });

            // Init Web Pertama Kali
            getGenres();
            discoverMovies(1);
        });
    </script>
</x-layout>