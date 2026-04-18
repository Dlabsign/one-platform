@php
date_default_timezone_set('Asia/Jakarta');

function getWeatherIcon($desc) {
    $desc = strtolower($desc ?? '');
    if (str_contains($desc, 'cerah')) {
        return '☀️';
    } elseif (str_contains($desc, 'berawan') || str_contains($desc, 'mendung')) {
        return '☁️';
    } elseif (str_contains($desc, 'hujan')) {
        return '🌧️';
    } elseif (str_contains($desc, 'petir') || str_contains($desc, 'badai')) {
        return '⛈️';
    } elseif (str_contains($desc, 'kabut')) {
        return '🌫️';
    } else {
        return '🌡️';
    }
}

$now = date('Y-m-d H:00:00');
$hariIni = date('Y-m-d');
$currentWeather = null;

if (!empty($weatherData['data'][0]['cuaca'][0])) {
    foreach ($weatherData['data'][0]['cuaca'][0] as $cuaca) {
        if ($cuaca['local_datetime'] >= $now) {
            $currentWeather = $cuaca;
            break;
        }
    }
    // fallback kalau gak ketemu
    $currentWeather = $currentWeather ?? $weatherData['data'][0]['cuaca'][0][0];
}
@endphp

<x-layout title="BMKG Geospasial - PDF Planet">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-10 pb-20">
        <div class="max-w-6xl mx-auto px-4">
            
            {{-- Header & Kontrol Wilayah --}}
            <div class="text-center mb-8">
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-4 tracking-tight">Prediksi Cuaca</h1>
                
                {{-- Form Pilih Daerah & Tombol GPS --}}
                <div class="flex flex-col md:flex-row justify-center items-center gap-4 max-w-2xl mx-auto bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-sm">
                    
                    <form action="{{ route('tools.weather') }}" method="GET" class="w-full md:w-auto flex gap-2">
                        <select name="wilayah" class="bg-gray-800 text-white border border-white/10 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer w-full">
                            <option value="35.15.08.2001" {{ request('wilayah') == '35.15.08.2001' ? 'selected' : '' }}>Sidoarjo, Jawa Timur</option>
                            <option value="31.71.01.1001" {{ request('wilayah') == '31.71.01.1001' ? 'selected' : '' }}>Gambir, Jakarta Pusat</option>
                            <option value="32.73.01.1001" {{ request('wilayah') == '32.73.01.1001' ? 'selected' : '' }}>Sumurbandung, Bandung</option>
                            <option value="34.71.01.1001" {{ request('wilayah') == '34.71.01.1001' ? 'selected' : '' }}>Tegalrejo, Yogyakarta</option>
                        </select>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-6 py-3 rounded-xl font-bold transition">Cari</button>
                    </form>

                    <span class="text-slate-500 font-bold hidden md:block">atau</span>

                    <button id="gpsBtn" class="w-full md:w-auto flex items-center justify-center gap-2 bg-teal-500/20 hover:bg-teal-500/40 text-teal-400 border border-teal-500/30 px-6 py-3 rounded-xl font-bold transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Gunakan Lokasi GPS
                    </button>
                </div>
            </div>

            {{-- Weather Summary Container --}}
            @if(!empty($currentWeather))
            <div id="weatherContainer" class="w-full bg-blue-500/10 px-4 py-8 md:p-12 rounded-[32px] border border-white/10 mb-8 transition-all duration-500 text-center flex flex-col items-center justify-center shadow-2xl backdrop-blur-sm relative overflow-hidden">
                
                {{-- Penanda Produksi Data (analysis_date) --}}
                <div class="absolute top-4 right-6 text-slate-400 text-[10px] font-bold tracking-widest uppercase flex items-center gap-2">
                    Updated: {{ date('d M, H:i', strtotime($weatherData['data'][0]['cuaca'][0][0]['analysis_date'] ?? $now)) }}
                </div>

                <div class="flex justify-center flex-wrap gap-2 md:gap-4 mb-6 w-full mt-4">
                    <span class="bg-blue-500 text-white px-6 py-2 rounded-full font-bold shadow-lg shadow-blue-500/20 uppercase tracking-widest text-xs">
                        {{ $weatherData['lokasi']['desa'] ?? 'Lokasi' }}
                    </span>
                    <span class="bg-white/5 text-slate-300 px-6 py-2 rounded-full font-semibold border border-white/10 text-xs">
                        {{ $weatherData['lokasi']['kecamatan'] ?? '' }}, {{ $weatherData['lokasi']['kotkab'] ?? '' }}
                    </span>
                </div>

                <div class="flex flex-col items-center justify-center mb-4">
                    <div class="text-6xl mb-4 animate-pulse">
                        {!! getWeatherIcon($currentWeather['weather_desc']) !!}
                    </div>
                    
                    {{-- Suhu Terkini --}}
                    <div class="w-full font-['Syne',sans-serif] text-[clamp(4rem,15vw,10rem)] font-black text-white leading-none tabular-nums tracking-tighter flex justify-center items-end" id="tempDisplay">
                        {{ $currentWeather['t'] }}<span class="text-blue-400 text-[0.4em] mb-4">°C</span>
                    </div>
                </div>
                
                <p class="text-2xl md:text-3xl font-['Syne',sans-serif] font-bold text-slate-300 mb-8 uppercase tracking-widest">
                    {{ $currentWeather['weather_desc'] }}
                </p>

                {{-- Detail Tambahan Sesuai Key --}}
                <div class="flex flex-wrap justify-center gap-4 md:gap-8 w-full max-w-2xl border-t border-white/10 pt-6">
                    <div class="flex flex-col items-center">
                        <span class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Kelembapan</span>
                        <span class="text-xl font-bold">{{ $currentWeather['hu'] }}<span class="text-xs text-slate-400 ml-1">%</span></span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Awan</span>
                        <span class="text-xl font-bold">{{ $currentWeather['tcc'] }}<span class="text-xs text-slate-400 ml-1">%</span></span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Jarak Pandang</span>
                        <span class="text-xl font-bold">{{ $currentWeather['vs_text'] }}</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-slate-500 text-[10px] uppercase font-bold tracking-widest mb-1">Angin</span>
                        <span class="text-xl font-bold">{{ $currentWeather['ws'] }}<span class="text-xs text-slate-400 ml-1">km/j</span></span>
                    </div>
                </div>
            </div>
            @endif

            {{-- Prakiraan Cuaca Per Jam (Hari Ini) --}}
            @if(!empty($weatherData['data'][0]['cuaca'][0]))
            <div class="bg-gray-900/50 p-6 md:p-8 rounded-[28px] border border-white/10 shadow-xl mb-12 backdrop-blur-md">
                <h2 class="font-['Syne',sans-serif] text-xl font-bold text-white mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Prakiraan Cuaca Hari Ini (Per Jam)
                </h2>
                
                <div class="flex gap-4 overflow-x-auto pb-4 snap-x custom-scrollbar">
                    @foreach($weatherData['data'][0]['cuaca'][0] as $cuaca)
                        @php
                            $waktuLokal = $cuaca['local_datetime']; // Format YYYY-MM-DD HH:mm:ss
                            $tanggalLoop = date('Y-m-d', strtotime($waktuLokal));
                            
                            // Logika: Hanya tampilkan hari ini dan jam >= sekarang
                            if ($tanggalLoop !== $hariIni || $waktuLokal < $now) {
                                continue;
                            }

                            $isCurrentHour = ($waktuLokal == $currentWeather['local_datetime']);
                        @endphp
                        
                        <div class="snap-center min-w-[200px] md:min-w-[220px] {{ $isCurrentHour ? 'bg-teal-500/20 border-teal-500/50' : 'bg-gray-800/50 border-white/5' }} p-5 rounded-2xl text-center border shadow-sm flex flex-col justify-between">
                            
                            {{-- Waktu (Jam) --}}
                            <div>
                                @if($isCurrentHour)
                                    <span class="inline-block bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full mb-2 animate-pulse uppercase tracking-wider">Sekarang</span>
                                @endif
                                <p class="text-lg font-bold text-white mb-3">{{ date('H:i', strtotime($waktuLokal)) }} WIB</p>
                            </div>

                            {{-- Icon & Deskripsi --}}
                            <div class="mb-4">
                                <div class="text-4xl mb-2">{!! getWeatherIcon($cuaca['weather_desc']) !!}</div>
                                <p class="text-[12px] font-semibold text-slate-300 uppercase tracking-wider h-8 flex items-center justify-center">
                                    {{ $cuaca['weather_desc'] }}
                                </p>
                            </div>

                            {{-- Parameter Suhu, Kelembapan, Angin --}}
                            <div class="border-t border-white/10 pt-4 flex flex-col gap-1">
                                <div class="font-['Syne',sans-serif] text-4xl font-black text-white mb-2 tabular-nums tracking-tighter flex justify-center items-start">
                                    {{ $cuaca['t'] }}<span class="text-blue-400 text-lg mt-1">°C</span>
                                </div>
                                <p class="text-[11px] text-slate-400 font-medium flex justify-between px-2">
                                    <span>💧 {{ $cuaca['hu'] }}%</span>
                                    <span>💨 {{ $cuaca['ws'] }} km/j</span>
                                </p>
                                <p class="text-[11px] text-slate-400 font-medium mt-1">
                                    🧭 Arah: {{ $cuaca['wd'] }}
                                </p>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-layout>