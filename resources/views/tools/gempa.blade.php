@php
    // Variabel ini asumsikan didapatkan dari Controller yang menembak API:
    // https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json
    // $gempaData = $response['Infogempa']['gempa'];
@endphp

<x-layout title="Gempa Bumi Terkini - BMKG">
    <x-navbar />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap');

        .bmkg-page {
            background: #080c14;
            color: #e2e8f0;
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            padding: 2.5rem 1rem 4rem;
        }

        .bmkg-inner {
            max-width: 960px;
            margin: 0 auto;
        }

        /* ── Header ── */
        .bmkg-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .bmkg-header-icon {
            width: 52px;
            height: 52px;
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.25);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            color: #f59e0b;
        }

        .bmkg-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.03em;
            margin-bottom: 0.5rem;
        }

        .bmkg-header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        /* ── Live Badge ── */
        .bmkg-live-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.25);
            border-radius: 999px;
            padding: 4px 14px;
            font-size: 0.68rem;
            font-weight: 500;
            color: #f59e0b;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 1.75rem;
        }

        .bmkg-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f59e0b;
            animation: bmkg-pulse 1.6s ease-in-out infinite;
        }

        @keyframes bmkg-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.25; }
        }

        /* ── Main Card ── */
        .bmkg-card {
            background: #0e1520;
            border: 1px solid #1e2d45;
            border-radius: 28px;
            overflow: hidden;
        }

        /* ── Top Bar ── */
        .bmkg-topbar {
            background: linear-gradient(90deg, rgba(245,158,11,0.06) 0%, transparent 60%);
            border-bottom: 1px solid #1e2d45;
            padding: 0.9rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .bmkg-topbar-item {
            font-size: 0.72rem;
            color: #64748b;
            letter-spacing: 0.04em;
        }

        .bmkg-topbar-item span {
            color: #e2e8f0;
            font-weight: 500;
        }

        /* ── Body grid ── */
        .bmkg-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        @media (max-width: 680px) {
            .bmkg-body { grid-template-columns: 1fr; }
            .bmkg-left { border-right: none !important; border-bottom: 1px solid #1e2d45; }
        }

        /* ── Left Pane ── */
        .bmkg-left {
            padding: 2rem;
            border-right: 1px solid #1e2d45;
        }

        .bmkg-hero-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 2rem;
        }

        .bmkg-stat {
            border-radius: 18px;
            padding: 1.25rem 1rem;
            text-align: center;
        }

        .bmkg-stat.amber {
            background: rgba(245, 158, 11, 0.12);
            border: 1px solid rgba(245, 158, 11, 0.25);
        }

        .bmkg-stat.neutral {
            background: #131b2a;
            border: 1px solid #1e2d45;
        }

        .bmkg-stat-label {
            display: block;
            font-size: 0.62rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.4rem;
        }

        .bmkg-stat.amber .bmkg-stat-label { color: rgba(245, 158, 11, 0.7); }
        .bmkg-stat.neutral .bmkg-stat-label { color: #64748b; }

        .bmkg-stat-val {
            display: block;
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            line-height: 1;
        }

        .bmkg-stat.amber .bmkg-stat-val { font-size: 3rem; color: #f59e0b; }
        .bmkg-stat.neutral .bmkg-stat-val { font-size: 2rem; color: #ffffff; }

        /* ── Info Rows ── */
        .bmkg-info { margin-bottom: 1.4rem; }

        .bmkg-info-label {
            font-size: 0.62rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin-bottom: 0.35rem;
        }

        .bmkg-info-val {
            font-size: 1rem;
            font-weight: 500;
            color: #ffffff;
            line-height: 1.4;
        }

        .bmkg-coords {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 0.45rem;
        }

        .bmkg-pill {
            background: #131b2a;
            border: 1px solid #1e2d45;
            border-radius: 999px;
            padding: 4px 14px;
            font-size: 0.74rem;
            color: #64748b;
        }

        .bmkg-divider {
            border: none;
            border-top: 1px solid #1e2d45;
            margin: 1.4rem 0;
        }

        .bmkg-felt {
            font-size: 0.9rem;
            color: #cbd5e1;
            line-height: 1.6;
        }

        .bmkg-potential {
            background: rgba(59, 130, 246, 0.08);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 16px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 1.2rem;
        }

        .bmkg-potential-icon { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }

        .bmkg-potential-title {
            font-size: 0.62rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #60a5fa;
            margin-bottom: 0.3rem;
        }

        .bmkg-potential-text {
            font-size: 0.85rem;
            color: #94a3b8;
            line-height: 1.5;
        }

        /* ── Right Pane ── */
        .bmkg-right {
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        .bmkg-map-label {
            font-size: 0.62rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .bmkg-map-wrap {
            flex: 1;
            background: #131b2a;
            border: 1px solid #1e2d45;
            border-radius: 20px;
            overflow: hidden;
            min-height: 340px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bmkg-map-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 20px;
            transition: transform 0.4s ease;
        }

        .bmkg-map-wrap img:hover { transform: scale(1.03); }

        /* ── Footer ── */
        .bmkg-footer {
            border-top: 1px solid #1e2d45;
            padding: 0.9rem 2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bmkg-footer-text {
            font-size: 0.7rem;
            color: #64748b;
        }

        .bmkg-footer-text span { color: #475569; }

        /* ── Empty state ── */
        .bmkg-empty {
            text-align: center;
            padding: 5rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            color: #475569;
        }

        .bmkg-empty p { font-size: 1rem; }
    </style>

    <div class="bmkg-page">
        <div class="bmkg-inner">

            {{-- Header --}}
            <div class="bmkg-header">
                <div class="bmkg-header-icon">
                    <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h1>Gempa Bumi Terkini</h1>
                <p>Informasi gempa terbaru langsung dari BMKG</p>
            </div>

            <div style="text-align:center">
                <span class="bmkg-live-badge">
                    <span class="bmkg-dot"></span>
                    Live Update
                </span>
            </div>

            @if(!empty($gempaData))

            <div class="bmkg-card">

                {{-- Top bar --}}
                <div class="bmkg-topbar">
                    <span class="bmkg-topbar-item">
                        Waktu UTC &nbsp;·&nbsp;
                        <span>{{ date('d M Y, H:i', strtotime($gempaData['DateTime'])) }}</span>
                    </span>
                    <span class="bmkg-topbar-item">
                        Sumber &nbsp;·&nbsp; <span>BMKG</span>
                    </span>
                </div>

                <div class="bmkg-body">

                    {{-- Left: Info Gempa --}}
                    <div class="bmkg-left">

                        {{-- Magnitudo & Kedalaman --}}
                        <div class="bmkg-hero-stats">
                            <div class="bmkg-stat amber">
                                <span class="bmkg-stat-label">Magnitudo</span>
                                <span class="bmkg-stat-val">{{ $gempaData['Magnitude'] }}</span>
                            </div>
                            <div class="bmkg-stat neutral">
                                <span class="bmkg-stat-label">Kedalaman</span>
                                <span class="bmkg-stat-val">{{ $gempaData['Kedalaman'] }}</span>
                            </div>
                        </div>

                        {{-- Waktu --}}
                        <div class="bmkg-info">
                            <div class="bmkg-info-label">Waktu Gempa (WIB)</div>
                            <div class="bmkg-info-val">
                                {{ $gempaData['Tanggal'] }}&nbsp;&nbsp;·&nbsp;&nbsp;{{ $gempaData['Jam'] }}
                            </div>
                        </div>

                        {{-- Lokasi --}}
                        <div class="bmkg-info">
                            <div class="bmkg-info-label">Pusat Gempa</div>
                            <div class="bmkg-info-val">{{ $gempaData['Wilayah'] }}</div>
                            <div class="bmkg-coords">
                                <span class="bmkg-pill">Lat: {{ $gempaData['Lintang'] }}</span>
                                <span class="bmkg-pill">Lon: {{ $gempaData['Bujur'] }}</span>
                            </div>
                        </div>

                        <hr class="bmkg-divider">

                        {{-- Dirasakan --}}
                        <div class="bmkg-info">
                            <div class="bmkg-info-label">Wilayah Dirasakan (MMI)</div>
                            <div class="bmkg-felt">{{ $gempaData['Dirasakan'] }}</div>
                        </div>

                        {{-- Potensi --}}
                        <div class="bmkg-potential">
                            <div class="bmkg-potential-icon">
                                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="bmkg-potential-title">Potensi / Peringatan</div>
                                <div class="bmkg-potential-text">{{ $gempaData['Potensi'] }}</div>
                            </div>
                        </div>

                    </div>

                    {{-- Right: Shakemap --}}
                    <div class="bmkg-right">
                        <div class="bmkg-map-label">Peta Guncangan (Shakemap)</div>
                        <div class="bmkg-map-wrap">
                            @php
                                $shakemapUrl = "https://static.bmkg.go.id/" . $gempaData['Shakemap'];
                                // Alternatif jika URL di atas tidak bekerja:
                                // $shakemapUrl = "https://data.bmkg.go.id/DataMKG/TEWS/" . $gempaData['Shakemap'];
                            @endphp
                            <img src="{{ $shakemapUrl }}"
                                 alt="Peta Guncangan Gempa BMKG"
                                 loading="lazy">
                        </div>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="bmkg-footer">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#475569" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path stroke-linecap="round" d="M12 6v6l4 2"/>
                    </svg>
                    <span class="bmkg-footer-text">
                        Terakhir diperbarui: <span>{{ date('d M Y, H:i', strtotime($gempaData['DateTime'])) }} UTC</span>
                        — Data bersumber dari API BMKG
                    </span>
                </div>

            </div>

            @else

            <div class="bmkg-card">
                <div class="bmkg-empty">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <p>Data gempa terkini sedang tidak tersedia.</p>
                </div>
            </div>

            @endif

        </div>
    </div>

</x-layout>