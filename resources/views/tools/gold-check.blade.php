<x-layout title="Metal Detect - Dlabsign">
    <x-navbar />

    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen pt-10 pb-20">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            
            {{-- Header --}}
            <div class="text-center mb-10 [animation:fadeSlideUp_0.6s_ease_both]">
                <div class="inline-flex items-center gap-2 bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 text-sm font-semibold px-4 py-1.5 rounded-full mb-4">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Powered by GoldAPI.io
                </div>
                <h1 class="text-[clamp(2rem,4vw,3rem)] font-['Syne',sans-serif] font-extrabold text-white mb-3">Live Metals Tracker</h1>
                <p class="text-slate-400 font-light text-lg max-w-2xl mx-auto">Pantau pergerakan harga Logam Mulia secara real-time berdasarkan jenis aset dan mata uang global.</p>
            </div>

            {{-- Main Workspace --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 [animation:fadeSlideUp_0.6s_0.1s_ease_both]">
                
                {{-- KIRI: KONTROL INPUT (Lebar 4/12) --}}
                <div class="lg:col-span-4 bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 flex flex-col h-fit">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-bold text-white font-['Syne',sans-serif] flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Pengaturan
                        </h2>
                    </div>

                    <div class="flex-1 space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1.5">Jenis Logam (Metal Symbol)</label>
                            <select id="metalSymbol" class="w-full bg-black/40 border border-white/10 text-slate-200 text-sm rounded-xl focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 p-3 outline-none transition">
                                <option value="XAU">Gold (XAU)</option>
                                <option value="XAG">Silver (XAG)</option>
                                <option value="XPT">Platinum (XPT)</option>
                                <option value="XPD">Palladium (XPD)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-1.5">Mata Uang (ISO 4217)</label>
                            <select id="currencyCode" class="w-full bg-black/40 border border-white/10 text-slate-200 text-sm rounded-xl focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 p-3 outline-none transition">
                                <option value="USD">USD - US Dollar</option>
                                <option value="EUR">EUR - Euro</option>
                                <option value="GBP">GBP - British Pound</option>
                                <option value="AUD">AUD - Australian Dollar</option>
                                <option value="JPY">JPY - Japanese Yen</option>
                            </select>
                        </div>
                    </div>
                    
                    <button id="refreshBtn" class="mt-8 w-full bg-yellow-600 hover:bg-yellow-500 text-white py-3.5 rounded-xl font-bold shadow-[0_0_20px_rgba(202,138,4,0.2)] transition-all flex items-center justify-center space-x-2 relative overflow-hidden group">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span>Update Harga</span>
                        </span>
                    </button>
                </div>

                {{-- KANAN: OUTPUT HARGA LENGKAP (Lebar 8/12) --}}
                <div class="lg:col-span-8 bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 relative min-h-[600px]">
                    
                    {{-- Loading Overlay --}}
                    <div id="loadingOverlay" class="absolute inset-0 bg-gray-900/90 backdrop-blur-sm rounded-[24px] flex flex-col items-center justify-center z-20 hidden">
                        <div class="w-16 h-16 border-4 border-yellow-500/20 border-t-yellow-500 rounded-full animate-spin mb-4"></div>
                        <p class="text-yellow-400 font-bold font-['Syne',sans-serif] animate-pulse">Mengambil Data Pasar...</p>
                    </div>

                    {{-- Header Informasi Pair --}}
                    <div class="flex flex-wrap justify-between items-end mb-6 border-b border-white/10 pb-4">
                        <div>
                            <h2 id="chartTitle" class="text-2xl font-bold text-white font-['Syne',sans-serif] tracking-wide mb-1">XAU / USD</h2>
                            <p class="text-sm text-slate-400">Exchange: <span id="exchangeName" class="text-slate-200 font-semibold">-</span> | Symbol: <span id="symbolName" class="text-slate-200 font-semibold">-</span></p>
                        </div>
                        <div class="text-right mt-4 sm:mt-0">
                            <p class="text-xs text-slate-500 mb-1">Update Terakhir</p>
                            <p id="lastUpdate" class="text-sm font-semibold text-slate-200 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">-</p>
                        </div>
                    </div>

                    {{-- Main Price Area --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-black/40 border border-white/5 rounded-2xl p-6 relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-yellow-500/10 blur-[40px] rounded-full pointer-events-none"></div>
                            <p class="text-slate-400 text-sm uppercase tracking-wider mb-2">Current Price (per oz)</p>
                            <h3 id="livePrice" class="text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 via-yellow-500 to-amber-500 font-['Syne',sans-serif] break-all">
                                $ 0.00
                            </h3>
                            <div class="mt-3 flex items-center gap-3">
                                <span id="priceChange" class="text-lg font-bold text-emerald-400">+0.00</span>
                                <span id="priceChangePct" class="text-sm font-semibold bg-emerald-400/10 text-emerald-400 px-2 py-1 rounded-md">+0.00%</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex flex-col justify-center">
                                <p class="text-xs text-slate-500 mb-1">Bid Price</p>
                                <p id="bidPrice" class="text-lg font-bold text-slate-200">$0.00</p>
                            </div>
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex flex-col justify-center">
                                <p class="text-xs text-slate-500 mb-1">Ask Price</p>
                                <p id="askPrice" class="text-lg font-bold text-slate-200">$0.00</p>
                            </div>
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex flex-col justify-center">
                                <p class="text-xs text-slate-500 mb-1">High</p>
                                <p id="highPrice" class="text-sm font-semibold text-emerald-400">$0.00</p>
                            </div>
                            <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex flex-col justify-center">
                                <p class="text-xs text-slate-500 mb-1">Low</p>
                                <p id="lowPrice" class="text-sm font-semibold text-red-400">$0.00</p>
                            </div>
                        </div>
                    </div>

                    {{-- Data Harian --}}
                    <div class="flex items-center gap-6 mb-8 px-2">
                        <div>
                            <p class="text-xs text-slate-500">Open Price</p>
                            <p id="openPrice" class="text-base font-semibold text-slate-300">$0.00</p>
                        </div>
                        <div class="w-px h-8 bg-white/10"></div>
                        <div>
                            <p class="text-xs text-slate-500">Previous Close</p>
                            <p id="prevClose" class="text-base font-semibold text-slate-300">$0.00</p>
                        </div>
                    </div>

                    {{-- Tabel Harga Per Karat (Hanya tampil jika nilainya ada di API) --}}
                    <div id="karatContainer" style="display: none;">
                        <h3 class="font-bold text-white font-['Syne',sans-serif] flex items-center gap-2 mb-4 border-b border-white/10 pb-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                            Harga Per Gram Berdasarkan Karat
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="bg-black/30 border border-amber-500/20 rounded-lg p-3 text-center">
                                <p class="text-amber-400 font-bold text-sm">24K</p>
                                <p id="k24" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">22K</p>
                                <p id="k22" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">21K</p>
                                <p id="k21" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">20K</p>
                                <p id="k20" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">18K</p>
                                <p id="k18" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">16K</p>
                                <p id="k16" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">14K</p>
                                <p id="k14" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                            <div class="bg-black/30 border border-white/5 rounded-lg p-3 text-center">
                                <p class="text-slate-400 font-bold text-sm">10K</p>
                                <p id="k10" class="text-slate-200 text-sm font-semibold mt-1">-</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const API_KEY = 'goldapi-14r6r219mnf0agcu-io'; 
            
            async function fetchMetalsData() {
                const symbol = document.getElementById('metalSymbol').value;
                const currency = document.getElementById('currencyCode').value;

                document.getElementById('loadingOverlay').classList.remove('hidden');

                try {
                    const response = await fetch(`https://www.goldapi.io/api/${symbol}/${currency}`, {
                        method: 'GET',
                        headers: {
                            'x-access-token': API_KEY,
                            'Content-Type': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error('API Error');

                    const data = await response.json();

                    // Format Mata Uang Standar Internasional (en-US)
                    const fmt = new Intl.NumberFormat('en-US', { style: 'currency', currency: currency, maximumFractionDigits: 2 });

                    // --- MENGISI DATA KE UI ---

                    // 1. Header & Identitas
                    document.getElementById('chartTitle').textContent = `${data.metal} / ${data.currency}`;
                    document.getElementById('exchangeName').textContent = data.exchange || '-';
                    document.getElementById('symbolName').textContent = data.symbol || '-';

                    // 2. Harga Utama & Change
                    document.getElementById('livePrice').textContent = fmt.format(data.price);
                    
                    const chEl = document.getElementById('priceChange');
                    const chpEl = document.getElementById('priceChangePct');
                    
                    const isPositive = data.ch >= 0;
                    chEl.textContent = (isPositive ? '+' : '') + fmt.format(data.ch);
                    chpEl.textContent = (isPositive ? '+' : '') + data.chp + '%';
                    
                    if(isPositive) {
                        chEl.className = "text-lg font-bold text-emerald-400";
                        chpEl.className = "text-sm font-semibold bg-emerald-400/10 text-emerald-400 px-2 py-1 rounded-md";
                    } else {
                        chEl.className = "text-lg font-bold text-red-400";
                        chpEl.className = "text-sm font-semibold bg-red-400/10 text-red-400 px-2 py-1 rounded-md";
                    }

                    // 3. Bid, Ask, High, Low, Open, Prev Close
                    document.getElementById('bidPrice').textContent = fmt.format(data.bid);
                    document.getElementById('askPrice').textContent = fmt.format(data.ask);
                    document.getElementById('highPrice').textContent = fmt.format(data.high_price);
                    document.getElementById('lowPrice').textContent = fmt.format(data.low_price);
                    document.getElementById('openPrice').textContent = fmt.format(data.open_price);
                    document.getElementById('prevClose').textContent = fmt.format(data.prev_close_price);

                    // 4. Harga per Karat (Jika datanya ada di API)
                    const karatContainer = document.getElementById('karatContainer');
                    if (data.price_gram_24k) {
                        karatContainer.style.display = 'block';
                        document.getElementById('k24').textContent = fmt.format(data.price_gram_24k);
                        document.getElementById('k22').textContent = fmt.format(data.price_gram_22k);
                        document.getElementById('k21').textContent = fmt.format(data.price_gram_21k);
                        document.getElementById('k20').textContent = fmt.format(data.price_gram_20k);
                        document.getElementById('k18').textContent = fmt.format(data.price_gram_18k);
                        document.getElementById('k16').textContent = fmt.format(data.price_gram_16k);
                        document.getElementById('k14').textContent = fmt.format(data.price_gram_14k);
                        document.getElementById('k10').textContent = fmt.format(data.price_gram_10k);
                    } else {
                        karatContainer.style.display = 'none';
                    }

                    // 5. Waktu Update (Dibiarkan tetap WIB agar sesuai lokasi Anda)
                    const date = new Date(data.timestamp * 1000);
                    document.getElementById('lastUpdate').textContent = date.toLocaleString('id-ID', { 
                        day: '2-digit', month: 'short', year: 'numeric', 
                        hour: '2-digit', minute: '2-digit', second: '2-digit' 
                    }) + ' WIB';

                } catch (error) {
                    console.error('Fetch Error:', error);
                    alert("Gagal mengambil data. Cek API Key atau koneksi Anda.");
                } finally {
                    document.getElementById('loadingOverlay').classList.add('hidden');
                }
            }

            // Inisiasi Pertama
            fetchMetalsData();
            document.getElementById('refreshBtn').addEventListener('click', fetchMetalsData);
        });
    </script>
</x-layout>