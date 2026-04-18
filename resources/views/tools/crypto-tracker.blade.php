<x-layout title="Crypto Tracker - Dlabsign">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            
            {{-- Header --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="inline-flex items-center gap-2 bg-cyan-500/10 border border-cyan-500/25 text-cyan-400 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    Powered by CoinStats
                </div>
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Live Crypto Tracker</h1>
                <p class="text-slate-400 font-light text-lg max-w-2xl mx-auto">Pantau pergerakan harga Cryptocurrency, konversi fiat, dan grafik historis secara real-time.</p>
            </div>

            {{-- Main Workspace --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                
                {{-- KIRI: KONTROL INPUT --}}
                <div class="lg:col-span-4 bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 flex flex-col h-fit">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-bold text-white font-['Syne',sans-serif] flex items-center gap-2">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Pengaturan
                        </h2>
                    </div>

                    <div class="flex-1 space-y-5">
                        {{-- Dropdown Kripto --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1.5">Pilih Kripto</label>
                            <select id="coinSelector" class="w-full bg-black/40 border border-white/10 text-slate-200 text-sm rounded-xl focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 p-3 outline-none transition disabled:opacity-50">
                                <option value="">Memuat data koin...</option>
                            </select>
                        </div>

                        {{-- Dropdown Mata Uang Negara --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1.5">Mata Uang (Fiat)</label>
                            <select id="fiatSelector" class="w-full bg-black/40 border border-white/10 text-slate-200 text-sm rounded-xl focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 p-3 outline-none transition disabled:opacity-50">
                                <option value="USD">USD - US Dollar</option>
                                <option value="IDR">IDR - Indonesian Rupiah</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">GBP - British Pound</option>
                                <option value="JPY">JPY - Japanese Yen</option>
                            </select>
                        </div>
                        
                        {{-- Opsi Periode Grafik --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1.5">Periode Grafik</label>
                            <select id="periodSelector" class="w-full bg-black/40 border border-white/10 text-slate-200 text-sm rounded-xl focus:ring-1 focus:ring-cyan-500 focus:border-cyan-500 p-3 outline-none transition">
                                <option value="1m">1 Bulan Terakhir</option>
                                <option value="1w">1 Minggu Terakhir</option>
                                <option value="3m">3 Bulan Terakhir</option>
                                <option value="1y">1 Tahun Terakhir</option>
                                <option value="all">Semua Data (All Time)</option>
                            </select>
                        </div>
                    </div>
                    
                    <button id="refreshBtn" class="mt-8 w-full bg-cyan-600 hover:bg-cyan-500 text-white py-3.5 rounded-xl font-bold shadow-[0_0_20px_rgba(6,182,212,0.2)] transition-all flex items-center justify-center space-x-2 relative overflow-hidden group">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span>Refresh Data</span>
                        </span>
                    </button>
                </div>

                {{-- KANAN: OUTPUT DATA & GRAFIK --}}
                <div class="lg:col-span-8 bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 relative min-h-[600px] flex flex-col">
                    
                    {{-- Loading Overlay --}}
                    <div id="loadingOverlay" class="absolute inset-0 bg-gray-900/90 backdrop-blur-sm rounded-[24px] flex flex-col items-center justify-center z-20 hidden">
                        <div class="w-16 h-16 border-4 border-cyan-500/20 border-t-cyan-500 rounded-full animate-spin mb-4"></div>
                        <p class="text-cyan-400 font-bold font-['Syne',sans-serif] animate-pulse">Mengambil Data...</p>
                    </div>

                    {{-- Header Informasi Koin --}}
                    <div class="flex flex-wrap justify-between items-end mb-6 border-b border-white/10 pb-4">
                        <div class="flex items-center gap-4">
                            <img id="coinIcon" src="" alt="Icon" class="w-12 h-12 rounded-full bg-white/5 p-1 hidden">
                            <div>
                                <h2 class="text-2xl font-bold text-white font-['Syne',sans-serif] tracking-wide mb-1 flex items-center gap-2">
                                    <span id="coinName">-</span> 
                                    <span id="coinSymbol" class="text-sm bg-white/10 px-2 py-0.5 rounded text-slate-300">-</span>
                                </h2>
                                <p class="text-sm text-slate-400">Peringkat Global: <span id="coinRank" class="text-cyan-400 font-semibold">#0</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Main Price Area --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-black/40 border border-white/5 rounded-2xl p-6 relative overflow-hidden flex flex-col justify-center">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-cyan-500/10 blur-[40px] rounded-full pointer-events-none"></div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider mb-2">Current Price (<span id="currencyLabel">USD</span>)</p>
                            <h3 id="livePrice" class="text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-cyan-500 to-blue-500 font-['Syne',sans-serif] break-all" style="color: yellow;">
                                $0.00
                            </h3>
                            <p id="priceBtc" class="text-sm text-slate-500 mt-1">0.00 BTC</p>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex justify-between items-center">
                                <p class="text-sm text-slate-400">Pergerakan (1 Jam)</p>
                                <span id="change1h" class="text-base font-bold bg-gray-800 px-3 py-1 rounded-md">0.00%</span>
                            </div>
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex justify-between items-center">
                                <p class="text-sm text-slate-400">Pergerakan (24 Jam)</p>
                                <span id="change1d" class="text-base font-bold bg-gray-800 px-3 py-1 rounded-md">0.00%</span>
                            </div>
                        </div>
                    </div>

                    {{-- AREA GRAFIK --}}
                    <div class="flex-1 min-h-[350px] bg-black/20 rounded-2xl p-4 border border-white/5 mb-6 relative">
                        <div id="priceChart" class="w-full h-full min-h-[300px]"></div>
                        <p id="chartError" class="absolute inset-0 flex items-center justify-center text-red-400 text-sm hidden font-semibold bg-black/50 backdrop-blur-sm rounded-2xl">Data grafik tidak tersedia.</p>
                    </div>

                    {{-- Market Stats --}}
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="bg-black/30 border border-white/5 rounded-lg p-4">
                            <p class="text-slate-500 text-xs mb-1">Market Cap</p>
                            <p id="marketCap" class="text-slate-200 text-sm font-semibold truncate">$0.00</p>
                        </div>
                        <div class="bg-black/30 border border-white/5 rounded-lg p-4">
                            <p class="text-slate-500 text-xs mb-1">Volume (24h)</p>
                            <p id="volume" class="text-slate-200 text-sm font-semibold truncate">$0.00</p>
                        </div>
                        <div class="bg-black/30 border border-white/5 rounded-lg p-4">
                            <p class="text-slate-500 text-xs mb-1">Circulating Supply</p>
                            <p id="availableSupply" class="text-slate-200 text-sm font-semibold truncate">0</p>
                        </div>
                        <div class="bg-black/30 border border-white/5 rounded-lg p-4">
                            <p class="text-slate-500 text-xs mb-1">Total Supply</p>
                            <p id="totalSupply" class="text-slate-200 text-sm font-semibold truncate">0</p>
                        </div>
                    </div>

                    {{-- Extra Data (Avg & Exchange Endpoints) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="bg-blue-900/10 border border-blue-500/20 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <p class="text-blue-400 text-xs mb-1 font-bold">Average Price</p>
                                <p id="avgGlobalPrice" class="text-slate-200 text-lg font-semibold truncate">Mengambil data...</p>
                            </div>
                            <svg class="w-6 h-6 text-blue-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                        </div>
                        <div class="bg-purple-900/10 border border-purple-500/20 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <p class="text-purple-400 text-xs mb-1 font-bold">Exchange Price</p>
                                <p id="exchangePrice" class="text-slate-200 text-lg font-semibold truncate">Mengambil data...</p>
                            </div>
                            <svg class="w-6 h-6 text-purple-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Masukkan API Key CoinStats Anda di sini
            const API_KEY = 'L0p+NdgC8hXX1XAjCH1drCJfvYRZMV7xTMObBZl9eyU='; 
            
            let coinsCache = [];
            let exchangeRates = {};
            let selectedCoinData = null;
            let chartInstance = null;

            const DOM = {
                coinSelector: document.getElementById('coinSelector'),
                fiatSelector: document.getElementById('fiatSelector'),
                periodSelector: document.getElementById('periodSelector'),
                overlay: document.getElementById('loadingOverlay'),
                refreshBtn: document.getElementById('refreshBtn'),
                chartError: document.getElementById('chartError'),
                
                icon: document.getElementById('coinIcon'),
                name: document.getElementById('coinName'),
                symbol: document.getElementById('coinSymbol'),
                rank: document.getElementById('coinRank'),
                
                currencyLabel: document.getElementById('currencyLabel'),
                price: document.getElementById('livePrice'),
                priceBtc: document.getElementById('priceBtc'),
                ch1h: document.getElementById('change1h'),
                ch1d: document.getElementById('change1d'),
                
                mcap: document.getElementById('marketCap'),
                volume: document.getElementById('volume'),
                circSupply: document.getElementById('availableSupply'),
                totalSupply: document.getElementById('totalSupply'),

                avgGlobalPrice: document.getElementById('avgGlobalPrice'),
                exchangePrice: document.getElementById('exchangePrice')
            };

            // --- FORMATTING HELPERS ---
            function formatFiat(value, currencyCode) {
                const isNoDecimal = ['IDR', 'JPY'].includes(currencyCode);
                return new Intl.NumberFormat('en-US', { 
                    style: 'currency', 
                    currency: currencyCode,
                    maximumFractionDigits: isNoDecimal ? 0 : 4
                }).format(value);
            }

            function stylePercentage(element, value) {
                const numValue = parseFloat(value) || 0;
                const isPositive = numValue >= 0;
                element.textContent = (isPositive ? '+' : '') + numValue.toFixed(2) + '%';
                element.className = `text-base font-bold px-3 py-1 rounded-md ${
                    isPositive ? 'bg-emerald-400/10 text-emerald-400' : 'bg-red-400/10 text-red-400'
                }`;
            }

            // --- 1. AMBIL NILAI TUKAR MATA UANG ---
            async function fetchExchangeRates() {
                try {
                    const response = await fetch('https://open.er-api.com/v6/latest/USD');
                    const data = await response.json();
                    if (data && data.rates) exchangeRates = data.rates;
                } catch (error) {
                    exchangeRates = { USD: 1, IDR: 15500, EUR: 0.92, GBP: 0.79, JPY: 150 };
                }
            }

            // --- 2. AMBIL LIST KOIN ---
            async function fetchCryptoList() {
                DOM.overlay.classList.remove('hidden');
                try {
                    if (Object.keys(exchangeRates).length === 0) await fetchExchangeRates();

                    const response = await fetch(`https://openapiv1.coinstats.app/coins?limit=50`, {
                        method: 'GET',
                        headers: { 'X-API-KEY': API_KEY, 'accept': 'application/json' }
                    });

                    const data = await response.json();
                    coinsCache = data.result || [];

                    DOM.coinSelector.innerHTML = '';
                    coinsCache.forEach(coin => {
                        const option = document.createElement('option');
                        option.value = coin.id;
                        option.textContent = `${coin.name} (${coin.symbol})`;
                        DOM.coinSelector.appendChild(option);
                    });

                    selectedCoinData = coinsCache.find(c => c.id === 'bitcoin') || coinsCache[0];
                    if(selectedCoinData) {
                        DOM.coinSelector.value = selectedCoinData.id;
                        updateUI();
                        await fetchAllExtraData(selectedCoinData.id);
                    }
                } catch (error) {
                    console.error('Fetch Error:', error);
                } finally {
                    DOM.overlay.classList.add('hidden');
                }
            }

            // --- 3. MENGAKALI GRAFIK (ROBUST PARSING + FALLBACK) ---
            async function fetchChartData(coinId) {
                const period = DOM.periodSelector.value;
                const fiat = DOM.fiatSelector.value;
                const rate = exchangeRates[fiat] || 1;
                
                DOM.chartError.classList.add('hidden');
                let chartSuccess = false;

                try {
                    const response = await fetch(`https://openapiv1.coinstats.app/coins/${coinId}/charts?period=${period}`, {
                        method: 'GET',
                        headers: { 'X-API-KEY': API_KEY, 'accept': 'application/json' }
                    });

                    const data = await response.json();
                    let chartPoints = [];

                    // AKALAN #1: Deteksi format JSON ganda dari CoinStats
                    if (Array.isArray(data)) {
                        if (data.length > 0 && Array.isArray(data[0])) chartPoints = data;
                        else if (data.length > 0 && data[0].chart) chartPoints = data[0].chart;
                    } else if (typeof data === 'object' && data !== null && data.chart) {
                        chartPoints = data.chart;
                    }

                    if (chartPoints.length > 0) {
                        const seriesData = [];
                        
                        // AKALAN #2: Pembersihan Data (Buang NaN & perbaiki detik jadi milidetik)
                        for (let item of chartPoints) {
                            if (Array.isArray(item) && item.length >= 2) {
                                let ts = Number(item[0]);
                                let price = Number(item[1]);
                                
                                if (!isNaN(ts) && !isNaN(price)) {
                                    if (ts < 10000000000) ts *= 1000; // Normalisasi milidetik
                                    seriesData.push([ts, price * rate]);
                                }
                            }
                        }

                        if (seriesData.length > 0) {
                            // AKALAN #3: Urutkan Waktu (Lama -> Baru) wajib untuk ApexCharts
                            seriesData.sort((a, b) => a[0] - b[0]);
                            renderChart(seriesData, fiat);
                            chartSuccess = true;
                        }
                    }
                } catch (error) {
                    console.error('Chart CoinStats error:', error);
                }

                // AKALAN #4: Jika endpoint chart error/kosong, Fallback (Gunakan API Coingecko)
                if (!chartSuccess) {
                    try {
                        const periodMap = { '1m': 30, '1w': 7, '3m': 90, '1y': 365, 'all': 'max' };
                        const days = periodMap[period] || 30;
                        const fallbackRes = await fetch(`https://api.coingecko.com/api/v3/coins/${coinId}/market_chart?vs_currency=usd&days=${days}`);
                        const fallbackData = await fallbackRes.json();
                        
                        if (fallbackData && fallbackData.prices) {
                            const seriesData = fallbackData.prices.map(item => [item[0], item[1] * rate]);
                            seriesData.sort((a, b) => a[0] - b[0]);
                            renderChart(seriesData, fiat);
                            chartSuccess = true;
                        }
                    } catch(e) {
                        console.error('Fallback Coingecko error:', e);
                    }
                }

                // Jika benar-benar gagal
                if (!chartSuccess) {
                    DOM.chartError.classList.remove('hidden');
                    renderChart([], fiat);
                }
            }

            // --- 4. RENDER GRAFIK ---
            function renderChart(seriesData, fiat) {
                const options = {
                    series: [{ name: 'Harga', data: seriesData }],
                    chart: {
                        type: 'area', height: 300,
                        fontFamily: 'DM Sans, sans-serif',
                        toolbar: { show: false },
                        animations: { enabled: false } // Matikan animasi agar transisi ganti koin mulus
                    },
                    colors: ['#06b6d4'],
                    fill: {
                        type: 'gradient',
                        gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.05, stops: [0, 100] }
                    },
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 2 },
                    xaxis: {
                        type: 'datetime',
                        labels: { style: { colors: '#94a3b8' } },
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        tooltip: { enabled: false }
                    },
                    yaxis: {
                        labels: {
                            style: { colors: '#94a3b8' },
                            formatter: (value) => formatFiat(value, fiat)
                        }
                    },
                    grid: { borderColor: '#ffffff10', strokeDashArray: 4 },
                    tooltip: {
                        theme: 'dark',
                        y: { formatter: (value) => formatFiat(value, fiat) },
                        x: { format: 'dd MMM yyyy, HH:mm' }
                    }
                };

                if (chartInstance) {
                    chartInstance.updateOptions({ yaxis: options.yaxis });
                    chartInstance.updateSeries([{ data: seriesData }]);
                } else {
                    chartInstance = new ApexCharts(document.querySelector("#priceChart"), options);
                    chartInstance.render();
                }
            }

            // --- 5. DATA EXTRA (Avg & Exchange Price) ---
            async function fetchEndpointsData(coinId) {
                const fiat = DOM.fiatSelector.value;
                const rate = exchangeRates[fiat] || 1;
                
                DOM.avgGlobalPrice.textContent = 'Memuat...';
                DOM.exchangePrice.textContent = 'Memuat...';

                // Fetch Avg Price
                try {
                    const res = await fetch(`https://openapiv1.coinstats.app/coins/price/avg?coinId=${coinId}`, {
                        headers: { 'X-API-KEY': API_KEY, 'accept': 'application/json' }
                    });
                    const data = await res.json();
                    let val = data.price || data.value || (Array.isArray(data) && data[0] ? data[0].price : null);
                    DOM.avgGlobalPrice.textContent = val ? formatFiat(val * rate, fiat) : '-';
                } catch(e) { DOM.avgGlobalPrice.textContent = '-'; }

                // Fetch Exchange Price
                try {
                    const res = await fetch(`https://openapiv1.coinstats.app/coins/price/exchange?coinId=${coinId}`, {
                        headers: { 'X-API-KEY': API_KEY, 'accept': 'application/json' }
                    });
                    const data = await res.json();
                    let val = data.price || data.value || (Array.isArray(data) && data[0] ? data[0].price : null);
                    DOM.exchangePrice.textContent = val ? formatFiat(val * rate, fiat) : '-';
                } catch(e) { DOM.exchangePrice.textContent = '-'; }
            }

            function updateUI() {
                if (!selectedCoinData) return;
                const coin = selectedCoinData;
                const fiat = DOM.fiatSelector.value;
                const rate = exchangeRates[fiat] || 1;

                DOM.icon.src = coin.icon;
                DOM.icon.classList.remove('hidden');
                DOM.name.textContent = coin.name;
                DOM.symbol.textContent = coin.symbol;
                DOM.rank.textContent = `#${coin.rank}`;
                
                DOM.currencyLabel.textContent = fiat;
                DOM.price.textContent = formatFiat(coin.price * rate, fiat);
                DOM.priceBtc.textContent = `${coin.priceBtc ? coin.priceBtc.toFixed(8) : '0'} BTC`;
                
                stylePercentage(DOM.ch1h, coin.priceChange1h);
                stylePercentage(DOM.ch1d, coin.priceChange1d);

                const compactFmt = new Intl.NumberFormat('en-US', { style: 'currency', currency: fiat, notation: "compact" });
                DOM.mcap.textContent = compactFmt.format(coin.marketCap * rate);
                DOM.volume.textContent = compactFmt.format(coin.volume * rate);
                
                DOM.circSupply.textContent = `${new Intl.NumberFormat('en-US', {notation: "compact"}).format(coin.availableSupply)} ${coin.symbol}`;
                DOM.totalSupply.textContent = `${new Intl.NumberFormat('en-US', {notation: "compact"}).format(coin.totalSupply)} ${coin.symbol}`;
            }

            async function fetchAllExtraData(coinId) {
                await Promise.all([
                    fetchChartData(coinId),
                    fetchEndpointsData(coinId)
                ]);
            }

            // --- EVENT LISTENERS ---
            DOM.coinSelector.addEventListener('change', async (e) => {
                DOM.overlay.classList.remove('hidden');
                selectedCoinData = coinsCache.find(c => c.id === e.target.value);
                updateUI();
                await fetchAllExtraData(selectedCoinData.id);
                DOM.overlay.classList.add('hidden');
            });

            DOM.fiatSelector.addEventListener('change', async () => {
                DOM.overlay.classList.remove('hidden');
                updateUI();
                await fetchAllExtraData(selectedCoinData.id); 
                DOM.overlay.classList.add('hidden');
            });

            DOM.periodSelector.addEventListener('change', async () => {
                DOM.overlay.classList.remove('hidden');
                await fetchChartData(selectedCoinData.id);
                DOM.overlay.classList.add('hidden');
            });

            DOM.refreshBtn.addEventListener('click', () => {
                fetchExchangeRates().then(() => fetchCryptoList()); 
            });

            // Start App
            fetchCryptoList();
        });
    </script>
</x-layout>