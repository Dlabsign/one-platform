<x-layout title="Jadwal & Hasil Liga 1 Indonesia - PDF Planet">
    <x-navbar />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500;600&display=swap');

        .custom-scroll::-webkit-scrollbar { width: 6px; height: 6px; }
        .custom-scroll::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.02); border-radius: 8px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: rgba(16, 185, 129, 0.3); border-radius: 8px; }
        .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(16, 185, 129, 0.6); }

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

            {{-- HEADER LIGA 1 --}}
            <div class="text-center mb-12 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/25 text-emerald-400 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path></svg>
                    Data Resmi TheSportsDB
                </div>
                <h1 class="text-[clamp(2rem,5vw,3.5rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Liga 1 <span class="text-emerald-400">Indonesia</span></h1>
                <p class="text-slate-400 font-light text-lg">Pantau jadwal, hasil pertandingan, dan klik logo klub untuk melihat detailnya.</p>
            </div>

            {{-- LOADING STATE --}}
            <div id="loadingState" class="text-center py-20 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="w-14 h-14 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-emerald-400 font-bold font-['Syne',sans-serif] animate-pulse">Memuat Data Liga 1...</p>
            </div>

            {{-- MAIN WRAPPER --}}
            <div id="mainDashboard" class="hidden [animation:fadeSlideUp_0.6s_ease_both]">
                
                {{-- DASHBOARD PERTANDINGAN (ATAS) --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <div class="bg-gray-900/80 backdrop-blur-md p-6 md:p-8 rounded-[28px] shadow-2xl border border-white/10 flex flex-col h-[600px]">
                        <div class="flex items-center justify-between mb-6 shrink-0 border-b border-white/5 pb-4">
                            <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-500 rounded-full animate-pulse"></span>
                                Jadwal Mendatang
                            </h2>
                        </div>
                        <div id="upcomingMatches" class="space-y-4 overflow-y-auto pr-2 custom-scroll flex-1"></div>
                    </div>

                    <div class="bg-gray-900/80 backdrop-blur-md p-6 md:p-8 rounded-[28px] shadow-2xl border border-white/10 flex flex-col h-[600px]">
                        <div class="flex items-center justify-between mb-6 shrink-0 border-b border-white/5 pb-4">
                            <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                                Hasil Pertandingan
                            </h2>
                        </div>
                        <div id="pastMatches" class="space-y-4 overflow-y-auto pr-2 custom-scroll flex-1"></div>
                    </div>
                </div>

                {{-- DAFTAR KLUB LIGA 1 (BAWAH) --}}
                <div class="bg-gray-900/80 backdrop-blur-md p-6 md:p-8 rounded-[28px] shadow-2xl border border-white/10 [animation:fadeSlideUp_0.6s_0.2s_ease_both]">
                    <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3 mb-6 shrink-0 border-b border-white/5 pb-4">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        Klub Peserta Liga 1
                    </h2>
                    <div id="teamsGrid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- MODAL DETAIL TIM --}}
    <div id="teamModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6">
        <div class="absolute inset-0 bg-[#0b0f1a]/90 backdrop-blur-sm" id="modalOverlay"></div>
        
        <div class="relative w-full max-w-5xl bg-gray-900/95 border border-white/10 rounded-[28px] shadow-2xl overflow-hidden flex flex-col max-h-[95vh] modal-content-enter">
            
            <button id="closeModalBtn" class="absolute top-4 right-4 z-20 bg-black/50 hover:bg-emerald-600 text-white w-10 h-10 rounded-full flex items-center justify-center backdrop-blur-md transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            {{-- Bagian Banner & Profil Singkat --}}
            <div class="relative h-48 md:h-64 bg-black overflow-hidden shrink-0">
                <img id="modalBanner" src="" class="w-full h-full object-cover opacity-50" alt="Banner">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 w-full p-6 md:p-8 flex items-end gap-6">
                    <img id="modalBadge" src="" class="w-24 h-24 md:w-32 md:h-32 object-contain drop-shadow-2xl bg-white/5 p-2 rounded-2xl backdrop-blur-md border border-white/10" alt="Logo">
                    <div class="flex-1 pb-2">
                        <h2 id="modalTeamName" class="text-3xl md:text-5xl font-black font-['Syne',sans-serif] text-white leading-none mb-2">Nama Klub</h2>
                        <div class="flex flex-wrap gap-3 text-sm font-semibold">
                            <span id="modalFormed" class="bg-emerald-500/20 text-emerald-300 px-3 py-1 rounded-lg border border-emerald-500/30">Est. 1900</span>
                            <span id="modalStadium" class="bg-white/10 text-slate-300 px-3 py-1 rounded-lg border border-white/10 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                Stadion
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Konten Bawah (Scrollable) --}}
            <div class="flex-1 overflow-y-auto custom-scroll p-6 md:p-8">
                
                <div id="modalLoading" class="hidden text-center py-10">
                    <div class="w-10 h-10 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin mx-auto mb-3"></div>
                    <p class="text-emerald-400 font-bold animate-pulse">Menyiapkan data klub...</p>
                </div>

                {{-- Layout Modal Baru (Tanpa Pemain) --}}
                <div id="modalContentBody" class="grid grid-cols-1 lg:grid-cols-2 gap-8 hidden">
                    
                    <div class="lg:col-span-2">
                        <h3 class="text-xl font-bold text-white font-['Syne',sans-serif] mb-3 border-b border-white/5 pb-2">Tentang Klub</h3>
                        <p id="modalDesc" class="text-sm text-slate-400 leading-relaxed font-light line-clamp-6 hover:line-clamp-none transition-all cursor-pointer" title="Klik untuk membaca selengkapnya">Deskripsi belum tersedia.</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-white font-['Syne',sans-serif] mb-3 border-b border-white/5 pb-2">Laga Berikutnya</h3>
                        <div id="modalNextMatches" class="space-y-3"></div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-white font-['Syne',sans-serif] mb-3 border-b border-white/5 pb-2">Laga Terakhir</h3>
                        <div id="modalPastMatches" class="space-y-3"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const LOCAL_API_URL = '/api/tools/sepak-bola';

            const loadingState = document.getElementById('loadingState');
            const mainDashboard = document.getElementById('mainDashboard');

            const teamModal = document.getElementById('teamModal');
            const modalOverlay = document.getElementById('modalOverlay');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const modalLoading = document.getElementById('modalLoading');
            const modalContentBody = document.getElementById('modalContentBody');

            function formatDate(dateString) {
                if (!dateString) return "TBD";
                const options = { day: 'numeric', month: 'short', year: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }

            // ==========================================
            // 1. MEMUAT HALAMAN UTAMA
            // ==========================================
            async function loadLeagueData() {
                try {
                    const [resSchedule, resTeams] = await Promise.all([
                        fetch(`${LOCAL_API_URL}/league-schedule`).then(r => r.json()),
                        fetch(`${LOCAL_API_URL}/league-teams`).then(r => r.json())
                    ]);

                    renderMatches('upcomingMatches', resSchedule.upcoming, false);
                    renderMatches('pastMatches', resSchedule.past, true);
                    renderTeams(resTeams.teams || []);

                    loadingState.classList.add('hidden');
                    mainDashboard.classList.remove('hidden');

                } catch (error) {
                    console.error("Error:", error);
                }
            }

            function renderMatches(containerId, matches, isResult) {
                const container = document.getElementById(containerId);
                container.innerHTML = '';
                
                if (!matches || matches.length === 0) {
                    container.innerHTML = `<div class="text-slate-500 italic p-6 text-center border border-white/5 rounded-2xl bg-black/20 h-full flex items-center justify-center">Data pertandingan belum tersedia di database.</div>`;
                    return;
                }

                matches.forEach(match => {
                    const matchDate = formatDate(match.dateEvent || match.strTimestamp);
                    const homeScore = match.intHomeScore !== null ? match.intHomeScore : '-';
                    const awayScore = match.intAwayScore !== null ? match.intAwayScore : '-';
                    const homeBadge = match.strHomeTeamBadge || 'https://via.placeholder.com/100?text=Logo';
                    const awayBadge = match.strAwayTeamBadge || 'https://via.placeholder.com/100?text=Logo';
                    
                    let scoreHtml = `<div class="text-2xl font-black text-emerald-400 tracking-widest bg-emerald-500/10 px-4 py-1.5 rounded-xl border border-emerald-500/20">${homeScore} - ${awayScore}</div>`;
                    if (!isResult) {
                        const time = match.strTime ? match.strTime.substring(0, 5) : 'TBD';
                        scoreHtml = `<div class="text-sm font-bold text-slate-300 bg-white/10 px-4 py-2 rounded-xl border border-white/10">Waktu:<br><span class="text-lg text-emerald-400">${time}</span></div>`;
                    }

                    const card = document.createElement('div');
                    card.className = 'bg-black/40 rounded-2xl border border-white/5 p-5 hover:border-emerald-500/30 transition hover:bg-black/60';
                    card.innerHTML = `
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest text-center border-b border-white/5 pb-3 mb-4">${matchDate}</div>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col items-center w-1/3"><img src="${homeBadge}" class="w-12 h-12 md:w-16 md:h-16 object-contain mb-2"><p class="font-bold text-white text-xs md:text-sm text-center line-clamp-2">${match.strHomeTeam}</p></div>
                            <div class="w-1/3 flex justify-center text-center">${scoreHtml}</div>
                            <div class="flex flex-col items-center w-1/3"><img src="${awayBadge}" class="w-12 h-12 md:w-16 md:h-16 object-contain mb-2"><p class="font-bold text-white text-xs md:text-sm text-center line-clamp-2">${match.strAwayTeam}</p></div>
                        </div>
                    `;
                    container.appendChild(card);
                });
            }

            function renderTeams(teams) {
                const container = document.getElementById('teamsGrid');
                container.innerHTML = '';

                teams.forEach(team => {
                    const card = document.createElement('div');
                    card.className = 'bg-black/40 rounded-2xl border border-white/5 p-4 hover:border-emerald-500/50 transition hover:bg-black/60 group flex flex-col items-center text-center cursor-pointer shadow-lg hover:-translate-y-1';
                    
                    card.onclick = () => openTeamModal(team.idTeam);

                    card.innerHTML = `
                        <img src="${team.strBadge || 'https://via.placeholder.com/100?text=Logo'}" alt="${team.strTeam}" class="w-16 h-16 md:w-20 md:h-20 object-contain mb-3 group-hover:scale-110 transition drop-shadow-lg">
                        <h3 class="font-bold text-white text-sm leading-tight line-clamp-2 mb-1">${team.strTeam}</h3>
                    `;
                    container.appendChild(card);
                });
            }

            // ==========================================
            // 2. MEMBUKA MODAL DETAIL KLUB
            // ==========================================
            async function openTeamModal(teamId) {
                teamModal.classList.remove('hidden');
                teamModal.classList.add('flex', 'modal-enter');
                document.body.style.overflow = 'hidden'; 
                
                modalContentBody.classList.add('hidden');
                modalLoading.classList.remove('hidden');

                document.getElementById('modalTeamName').textContent = "Memuat...";
                document.getElementById('modalBanner').src = "";
                document.getElementById('modalBadge').src = "";

                try {
                    // Hanya 3 data sekarang (tanpa players)
                    const [resTeam, resPast, resNext] = await Promise.all([
                        fetch(`${LOCAL_API_URL}/team-detail?id=${teamId}`).then(r => r.json()),
                        fetch(`${LOCAL_API_URL}/team-past?id=${teamId}`).then(r => r.json()),
                        fetch(`${LOCAL_API_URL}/team-upcoming?id=${teamId}`).then(r => r.json())
                    ]);

                    const team = resTeam.teams && resTeam.teams.length > 0 ? resTeam.teams[0] : null;
                    if (!team) throw new Error("Data tim tidak ditemukan");

                    document.getElementById('modalTeamName').textContent = team.strTeam;
                    document.getElementById('modalFormed').textContent = team.intFormedYear ? `Est. ${team.intFormedYear}` : 'Est. Unknown';
                    document.getElementById('modalStadium').innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg> ${team.strStadium || 'Stadion Tidak Diketahui'} ${team.intStadiumCapacity ? `(${Number(team.intStadiumCapacity).toLocaleString()})` : ''}`;
                    document.getElementById('modalDesc').textContent = team.strDescriptionID || team.strDescriptionEN || 'Deskripsi klub belum tersedia.';
                    
                    document.getElementById('modalBadge').src = team.strBadge || 'https://via.placeholder.com/200?text=No+Logo';
                    document.getElementById('modalBanner').src = team.strTeamBanner || team.strStadiumThumb || team.strTeamFanart1 || 'https://images.unsplash.com/photo-1518605368461-1e967a1ccfcc?auto=format&fit=crop&q=80&w=2000';

                    renderSmallMatches('modalNextMatches', resNext.events);
                    renderSmallMatches('modalPastMatches', resPast.results);

                    modalLoading.classList.add('hidden');
                    modalContentBody.classList.remove('hidden');

                } catch (error) {
                    console.error("Gagal load detail tim:", error);
                    document.getElementById('modalDesc').textContent = "Terjadi kesalahan saat memuat data dari server pusat.";
                    modalLoading.classList.add('hidden');
                    modalContentBody.classList.remove('hidden');
                }
            }

            function renderSmallMatches(containerId, matches) {
                const container = document.getElementById(containerId);
                container.innerHTML = '';
                if (!matches || matches.length === 0) {
                    container.innerHTML = `<div class="text-slate-500 italic p-3 text-xs bg-black/20 rounded-xl border border-white/5">Tidak ada jadwal/hasil.</div>`;
                    return;
                }
                
                matches.slice(0, 5).forEach(m => {
                    const el = document.createElement('div');
                    el.className = 'flex justify-between items-center bg-black/30 p-3 rounded-xl border border-white/5 hover:border-emerald-500/30 transition';
                    el.innerHTML = `
                        <div class="flex-1 text-right text-xs font-bold text-white line-clamp-1">${m.strHomeTeam}</div>
                        <div class="px-3 shrink-0 text-center">
                            ${m.intHomeScore !== null ? 
                                `<span class="text-emerald-400 font-black px-2 py-1 bg-emerald-500/10 rounded">${m.intHomeScore} - ${m.intAwayScore}</span>` : 
                                `<span class="text-[10px] text-slate-400 font-bold px-2 py-1 bg-white/5 rounded">${m.strTime ? m.strTime.substring(0,5) : 'VS'}</span>`
                            }
                        </div>
                        <div class="flex-1 text-left text-xs font-bold text-white line-clamp-1">${m.strAwayTeam}</div>
                    `;
                    container.appendChild(el);
                });
            }

            function closeModal() {
                teamModal.classList.add('hidden');
                teamModal.classList.remove('flex', 'modal-enter');
                document.body.style.overflow = 'auto'; 
            }

            closeModalBtn.addEventListener('click', closeModal);
            modalOverlay.addEventListener('click', closeModal);

            // Init
            loadLeagueData();
        });
    </script>
</x-layout>