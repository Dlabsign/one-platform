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
                <p class="text-slate-400 font-light text-lg">Pantau jadwal, hasil pertandingan, dan daftar klub kasta tertinggi sepak bola Indonesia.</p>
            </div>

            {{-- LOADING STATE --}}
            <div id="loadingState" class="text-center py-20 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="w-14 h-14 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin mx-auto mb-4"></div>
                <p class="text-emerald-400 font-bold font-['Syne',sans-serif] animate-pulse">Memuat Data Liga 1...</p>
            </div>

            {{-- ERROR STATE --}}
            <div id="errorState" class="hidden text-center py-16 bg-red-500/5 backdrop-blur-md rounded-[28px] border border-red-500/20 [animation:fadeSlideUp_0.6s_ease_both]">
                <h3 class="text-xl font-bold text-slate-200 mb-2 font-['Syne',sans-serif]">Gagal Memuat Data</h3>
                <p class="text-slate-400">Terjadi kesalahan pada server API. Silakan muat ulang halaman.</p>
            </div>

            {{-- MAIN WRAPPER --}}
            <div id="mainDashboard" class="hidden [animation:fadeSlideUp_0.6s_ease_both]">
                
                {{-- DASHBOARD PERTANDINGAN (ATAS) --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    {{-- KIRI: JADWAL SELANJUTNYA --}}
                    <div class="bg-gray-900/80 backdrop-blur-md p-6 md:p-8 rounded-[28px] shadow-2xl border border-white/10 flex flex-col h-[600px]">
                        <div class="flex items-center justify-between mb-6 shrink-0 border-b border-white/5 pb-4">
                            <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-500 rounded-full animate-pulse"></span>
                                Jadwal Mendatang
                            </h2>
                        </div>
                        <div id="upcomingMatches" class="space-y-4 overflow-y-auto pr-2 custom-scroll flex-1">
                            {{-- Diisi JS --}}
                        </div>
                    </div>

                    {{-- KANAN: HASIL TERAKHIR --}}
                    <div class="bg-gray-900/80 backdrop-blur-md p-6 md:p-8 rounded-[28px] shadow-2xl border border-white/10 flex flex-col h-[600px]">
                        <div class="flex items-center justify-between mb-6 shrink-0 border-b border-white/5 pb-4">
                            <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3">
                                <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                                Hasil Pertandingan
                            </h2>
                        </div>
                        <div id="pastMatches" class="space-y-4 overflow-y-auto pr-2 custom-scroll flex-1">
                            {{-- Diisi JS --}}
                        </div>
                    </div>
                </div>

                {{-- DAFTAR KLUB LIGA 1 (BAWAH) --}}
                <div class="bg-gray-900/80 backdrop-blur-md p-6 md:p-8 rounded-[28px] shadow-2xl border border-white/10 [animation:fadeSlideUp_0.6s_0.2s_ease_both]">
                    <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] flex items-center gap-3 mb-6 shrink-0 border-b border-white/5 pb-4">
                        <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                        Klub Peserta Liga 1
                    </h2>
                    <div id="teamsGrid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        {{-- Diisi JS --}}
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const LOCAL_API_URL = '/api/tools/sepak-bola';

            const loadingState = document.getElementById('loadingState');
            const errorState = document.getElementById('errorState');
            const mainDashboard = document.getElementById('mainDashboard');

            function formatDate(dateString) {
                if (!dateString) return "Tanggal Belum Ditentukan";
                const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }

            async function loadLeagueData() {
                try {
                    // Fetch Data Jadwal, Hasil, dan Klub sekaligus (Paralel)
                    const [resUpcoming, resPast, resTeams] = await Promise.all([
                        fetch(`${LOCAL_API_URL}/league-upcoming`).then(r => r.json()),
                        fetch(`${LOCAL_API_URL}/league-past`).then(r => r.json()),
                        fetch(`${LOCAL_API_URL}/league-teams`).then(r => r.json())
                    ]);

                    const upcomingData = (resUpcoming.events || []).slice(0, 15);
                    const pastData = (resPast.events || []).slice(0, 15);
                    const teamsData = resTeams.teams || [];

                    // Render ke UI
                    renderMatches('upcomingMatches', upcomingData, false);
                    renderMatches('pastMatches', pastData, true);
                    renderTeams(teamsData);

                    loadingState.classList.add('hidden');
                    mainDashboard.classList.remove('hidden');

                } catch (error) {
                    console.error("Error Fetching League Data:", error);
                    loadingState.classList.add('hidden');
                    errorState.classList.remove('hidden');
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
                    card.className = 'bg-black/40 rounded-2xl border border-white/5 p-5 hover:border-emerald-500/30 transition hover:bg-black/60 group';
                    
                    card.innerHTML = `
                        <div class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest text-center border-b border-white/5 pb-3 mb-4">
                            ${matchDate}
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex flex-col items-center w-1/3">
                                <img src="${homeBadge}" alt="${match.strHomeTeam}" class="w-12 h-12 md:w-16 md:h-16 object-contain mb-2 group-hover:scale-110 transition drop-shadow-lg">
                                <p class="font-bold text-white text-xs md:text-sm text-center leading-tight line-clamp-2">${match.strHomeTeam}</p>
                            </div>
                            <div class="w-1/3 flex justify-center text-center">
                                ${scoreHtml}
                            </div>
                            <div class="flex flex-col items-center w-1/3">
                                <img src="${awayBadge}" alt="${match.strAwayTeam}" class="w-12 h-12 md:w-16 md:h-16 object-contain mb-2 group-hover:scale-110 transition drop-shadow-lg">
                                <p class="font-bold text-white text-xs md:text-sm text-center leading-tight line-clamp-2">${match.strAwayTeam}</p>
                            </div>
                        </div>
                    `;
                    container.appendChild(card);
                });
            }

            function renderTeams(teams) {
                const container = document.getElementById('teamsGrid');
                container.innerHTML = '';

                if (!teams || teams.length === 0) {
                    container.innerHTML = `<div class="col-span-full text-slate-500 italic p-6 text-center border border-white/5 rounded-2xl bg-black/20">Data klub belum tersedia.</div>`;
                    return;
                }

                teams.forEach(team => {
                    const badge = team.strBadge || 'https://via.placeholder.com/100?text=Logo';
                    const teamName = team.strTeam;
                    const stadium = team.strStadium || 'Stadion Tidak Diketahui';

                    const card = document.createElement('div');
                    card.className = 'bg-black/40 rounded-2xl border border-white/5 p-4 hover:border-emerald-500/30 transition hover:bg-black/60 group flex flex-col items-center text-center';

                    card.innerHTML = `
                        <img src="${badge}" alt="${teamName}" class="w-16 h-16 md:w-20 md:h-20 object-contain mb-3 group-hover:scale-110 transition drop-shadow-lg">
                        <h3 class="font-bold text-white text-sm leading-tight line-clamp-2 mb-1">${teamName}</h3>
                        <p class="text-[10px] text-slate-400 line-clamp-1">${stadium}</p>
                    `;

                    container.appendChild(card);
                });
            }

            // Jalankan fungsi saat web dibuka
            loadLeagueData();
        });
    </script>
</x-layout>