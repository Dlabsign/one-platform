<x-layout title="Cafe Finder - Rekomendasi Kafe Mahasiswa - PDF Planet">
    <x-navbar />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500&display=swap');

        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 8px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(45, 212, 191, 0.3);
            border-radius: 8px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(45, 212, 191, 0.6);
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

        /* Dihapus: CSS popup gelap, dibiarkan default terang bawaan Leaflet */
        .custom-div-icon {
            background: transparent;
            border: none;
        }

        select option {
            background-color: #0b0f1a;
            color: #f1f5f9;
        }
    </style>

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-8 pb-16">
        <div class="max-w-[1500px] mx-auto px-4 md:px-8">

            {{-- HEADER --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <h1 class="text-[clamp(2rem,5vw,3.5rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Cafe <span class="text-teal-400">Finder</span></h1>
                <p class="text-slate-400 font-light text-lg max-w-2xl mx-auto">Temukan kafe nugas paling estetik, murah, dan nyaman di kotamu berdasarkan rekomendasi AI. (100% Free Maps)</p>
            </div>

            {{-- FORM INPUT PENCARIAN --}}
            <div class="max-w-4xl mx-auto mb-10 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                <div class="bg-gray-900/80 backdrop-blur-md p-7 rounded-[28px] shadow-2xl border border-white/10">
                    <h2 class="font-bold text-white font-['Syne',sans-serif] text-xl mb-5 flex items-center gap-2.5">
                        <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Atur Pencarian Kafe
                    </h2>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wider">Provinsi</label>
                                <select id="provinsiSelect" class="w-full bg-black/40 border border-white/5 rounded-xl p-3.5 text-slate-200 focus:outline-none focus:border-teal-500/50 focus:ring-1 focus:ring-teal-500/50 transition cursor-pointer">
                                    <option value="">-- Pilih Provinsi --</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wider">Kab/Kota</label>
                                <select id="kabkotaSelect" class="w-full bg-black/40 border border-white/5 rounded-xl p-3.5 text-slate-200 focus:outline-none focus:border-teal-500/50 focus:ring-1 focus:ring-teal-500/50 transition opacity-50 cursor-not-allowed" disabled>
                                    <option value="">-- Pilih Kab/Kota --</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-400 mb-2 uppercase tracking-wider">Tipe kafe yang dicari?</label>
                            <textarea id="preferenceInput" class="w-full bg-black/40 border border-white/5 rounded-xl p-4 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-teal-500/50 focus:ring-1 focus:ring-teal-500/50 transition resize-none h-20 custom-scroll" placeholder="Contoh: estetik, ada wifi, colokan banyak, kopi enak..."></textarea>
                        </div>

                        <button id="findBtn" class="w-full bg-teal-500 hover:bg-teal-400 text-gray-900 py-4 rounded-xl font-bold shadow-[0_0_20px_rgba(45,212,191,0.2)] transition-all flex items-center justify-center space-x-2 relative group mt-4">
                            <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Cari Kafe</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- HASIL & PETA --}}
            <div id="mainResultsWrapper" class="hidden grid grid-cols-1 lg:grid-cols-12 gap-6 [animation:fadeSlideUp_0.6s_ease_both]">

                {{-- KIRI: LIST REKOMENDASI --}}
                <div class="lg:col-span-5 flex flex-col">
                    <div class="bg-gray-900/80 backdrop-blur-md p-7 rounded-[28px] shadow-2xl border border-white/10 flex-1 min-h-[500px] relative">

                        <div id="loadingOverlay" class="absolute inset-0 bg-gray-900/90 backdrop-blur-sm rounded-[28px] flex flex-col items-center justify-center z-20 hidden">
                            <div class="w-14 h-14 border-4 border-teal-500/20 border-t-teal-500 rounded-full animate-spin mb-4"></div>
                            <p class="text-teal-400 font-bold font-['Syne',sans-serif] animate-pulse">AI Sedang Mencari...</p>
                        </div>

                        <h2 class="font-bold text-white font-['Syne',sans-serif] text-xl mb-5 flex items-center gap-2.5">
                            <svg class="w-6 h-6 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20l-4-4m0-7A7 7 0 111 8a7 7 0 0114 0z"></path>
                            </svg>
                            Rekomendasi Kafe
                        </h2>

                        <ul id="cafeList" class="space-y-4 h-[550px] overflow-y-auto pr-2 custom-scroll"></ul>
                    </div>
                </div>

                {{-- KANAN: PETA TERANG --}}
                <div class="lg:col-span-7 bg-white backdrop-blur-md rounded-[28px] shadow-2xl border border-white/10 overflow-hidden h-[600px] lg:h-auto lg:sticky lg:top-24 relative z-0">
                    <div id="map" class="w-full h-full bg-gray-200 z-0"></div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let map;
            let markersLayer;
            let isMapInitialized = false;

            function initMap() {
                if (isMapInitialized) return;
                map = L.map('map').setView([-2.5489, 118.0148], 5);
                markersLayer = new L.FeatureGroup().addTo(map);

                // MENGGUNAKAN TILE LAYER STANDARD (TERANG & JELAS)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                isMapInitialized = true;
            }

            // Ikon Biru/Teal untuk kontras di peta terang
            const cafeIcon = L.divIcon({
                className: 'custom-div-icon',
                html: `<div style="background-color:#0f766e; width:18px; height:18px; border-radius:50%; border:3px solid #fff; box-shadow: 0 0 10px rgba(0,0,0,0.5);"></div>`,
                iconSize: [18, 18],
                iconAnchor: [9, 9]
            });

            const provSelect = document.getElementById('provinsiSelect');
            const kabSelect = document.getElementById('kabkotaSelect');

            fetch('https://alamat.thecloudalert.com/api/provinsi/get/')
                .then(res => res.json())
                .then(data => {
                    if (data.status === 200) {
                        data.result.forEach(prov => {
                            const option = document.createElement('option');
                            option.value = prov.id;
                            option.text = prov.text;
                            provSelect.add(option);
                        });
                    }
                });

            provSelect.addEventListener('change', function() {
                const provId = this.value;
                kabSelect.innerHTML = '<option value="">-- Pilih Kab/Kota --</option>';
                kabSelect.disabled = true;
                kabSelect.classList.add('opacity-50', 'cursor-not-allowed');

                if (provId) {
                    fetch(`https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id=${provId}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 200) {
                                data.result.forEach(kab => {
                                    const option = document.createElement('option');
                                    option.value = kab.id;
                                    option.text = kab.text;
                                    kabSelect.add(option);
                                });
                                kabSelect.disabled = false;
                                kabSelect.classList.remove('opacity-50', 'cursor-not-allowed');
                            }
                        });
                }
            });

            document.getElementById('findBtn').onclick = async () => {
                const preferences = document.getElementById('preferenceInput').value.trim();

                if (!provSelect.value || !kabSelect.value) return alert('Silakan pilih Provinsi dan Kabupaten/Kota terlebih dahulu!');
                if (!preferences) return alert('Isi dulu tipe kafe yang kamu cari!');

                const provText = provSelect.options[provSelect.selectedIndex].text;
                const kabText = kabSelect.options[kabSelect.selectedIndex].text;
                const searchLocation = `${kabText}, ${provText}`;

                const resultsWrapper = document.getElementById('mainResultsWrapper');
                resultsWrapper.classList.remove('hidden');
                resultsWrapper.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                initMap();
                setTimeout(() => {
                    map.invalidateSize();
                }, 300);

                document.getElementById('loadingOverlay').classList.remove('hidden');
                markersLayer.clearLayers();

                try {
                    const res = await fetch("{{ route('tools.processCafeFinder') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            city: searchLocation,
                            preferences: preferences
                        })
                    });

                    const data = await res.json();
                    if (!res.ok) throw new Error(data.message || 'Gagal mengambil data');

                    const list = document.getElementById('cafeList');
                    list.innerHTML = '';

                    if (!data.cafes || data.cafes.length === 0) {
                        list.innerHTML = `<li class="text-center text-slate-500 py-8">Tidak ditemukan kafe di kota tersebut.</li>`;
                        return;
                    }

                    map.flyTo([data.city_center.lat, data.city_center.lng], 13);

                    data.cafes.forEach((cafe, i) => {
                        // Tambahkan RATING pada Popup Peta
                        const marker = L.marker([cafe.geometry.location.lat, cafe.geometry.location.lng], {
                                icon: cafeIcon
                            })
                            .addTo(markersLayer)
                            .bindPopup(`
                                <div style="text-align:center;">
                                    <b style="font-size:14px; color:#1f2937;">${cafe.name}</b><br>
                                    <span style="color:#f59e0b; font-weight:bold;">⭐ ${cafe.rating}</span><br>
                                    <span style="font-size:12px; color:#6b7280;">${cafe.distance_text}</span>
                                </div>
                            `);

                        const gmapsUrl = `https://www.google.com/maps/search/?api=1&query=${cafe.geometry.location.lat},${cafe.geometry.location.lng}`;

                        const li = document.createElement('li');
                        li.className = 'flex items-start gap-4 p-5 bg-gray-800/50 border border-white/5 rounded-2xl hover:border-teal-400/30 transition group cursor-pointer';

                        // TAMPILAN BARU: RATING & JAM BUKA
                        li.innerHTML = `
                            <div class="font-['Syne',sans-serif] font-bold text-2xl text-teal-600 group-hover:text-teal-400 transition pt-1">${i + 1}.</div>
                            <div class="flex-1 space-y-2">
                                <div class="flex justify-between items-start gap-3">
                                    <h3 class="font-bold text-white text-lg font-['Syne',sans-serif] group-hover:text-teal-400 transition">${cafe.name}</h3>
                                    
                                    <div class="text-right flex-shrink-0">
                                        <div class="flex items-center gap-1 text-amber-400 justify-end mb-1">
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                                            <span class="font-bold text-sm text-white">${cafe.rating}</span>
                                        </div>
                                        <div class="text-xs text-slate-500 font-medium whitespace-nowrap">${cafe.distance_text}</div>
                                    </div>
                                </div>
                                
                                <p class="text-slate-400 text-sm font-light leading-relaxed">${cafe.vicinity}</p>
                                
                                {{-- INFORMASI JAM BUKA --}}
                                <div class="flex items-center gap-1.5 text-xs font-medium text-teal-300 bg-teal-500/10 px-2.5 py-1.5 rounded-md w-fit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    ${cafe.opening_hours}
                                </div>
                                
                                <a href="${gmapsUrl}" target="_blank" onclick="event.stopPropagation()" class="inline-flex items-center gap-1.5 mt-2 text-xs font-semibold text-teal-400 border border-teal-400/30 bg-teal-400/5 hover:bg-teal-400 hover:text-gray-900 px-3 py-1.5 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Buka di Maps
                                </a>
                            </div>
                        `;

                        li.onclick = () => {
                            map.flyTo([cafe.geometry.location.lat, cafe.geometry.location.lng], 17);
                            marker.openPopup();
                        };

                        list.appendChild(li);
                    });

                    setTimeout(() => {
                        map.fitBounds(markersLayer.getBounds(), {
                            padding: [50, 50]
                        });
                    }, 1000);

                } catch (e) {
                    alert(e.message);
                } finally {
                    document.getElementById('loadingOverlay').classList.add('hidden');
                }
            };
        });
    </script>
</x-layout>