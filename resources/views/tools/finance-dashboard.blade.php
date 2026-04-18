<x-app-layout>
    <div class="bg-[#0b0f1a] text-slate-100 font-['DM_Sans',sans-serif] min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-8 space-y-6">

            {{-- Toast Flash Message --}}
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="fixed top-5 right-5 z-50 bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 px-6 py-3 rounded-xl shadow-lg backdrop-blur-md flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
            @endif

            {{-- SUMMARY CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-900/80 backdrop-blur-md border border-emerald-500/20 p-6 rounded-[24px] shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/10 blur-[40px] rounded-full"></div>
                    <p class="text-emerald-400 text-sm font-semibold mb-1">Total Pemasukan</p>
                    <h3 class="text-3xl font-extrabold text-white">Rp {{ number_format($pemasukan, 0, ',', '.') }}</h3>
                </div>
                
                <div class="bg-gray-900/80 backdrop-blur-md border border-red-500/20 p-6 rounded-[24px] shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-red-500/10 blur-[40px] rounded-full"></div>
                    <p class="text-red-400 text-sm font-semibold mb-1">Total Pengeluaran</p>
                    <h3 class="text-3xl font-extrabold text-white">Rp {{ number_format($pengeluaran, 0, ',', '.') }}</h3>
                </div>

                <div class="bg-blue-600/20 backdrop-blur-md border border-blue-500/30 p-6 rounded-[24px] shadow-2xl relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-blue-400/20 blur-[40px] rounded-full"></div>
                    <p class="text-blue-300 text-sm font-semibold mb-1">Saldo Saat Ini</p>
                    <h3 class="text-4xl font-extrabold text-white">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KIRI: FORM INPUT TRANSAKSI (Lebar 1/3) --}}
                <div class="bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 lg:col-span-1">
                    <h2 class="font-bold text-white text-lg mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Catat Transaksi
                    </h2>

                    <form action="{{ route('transactions.store') }}" method="POST" class="space-y-4" x-data="{ loading: false }" @submit="loading = true">
                        @csrf
                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Jenis Transaksi</label>
                            <select name="type" required class="w-full bg-black/40 border border-white/10 text-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 outline-none">
                                <option value="pemasukan">Pemasukan</option>
                                <option value="pengeluaran">Pengeluaran</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Jumlah (Rp)</label>
                            <input type="number" name="amount" required class="w-full bg-black/40 border border-white/10 text-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 outline-none placeholder-slate-600" placeholder="Contoh: 500000">
                        </div>
                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Tanggal</label>
                            <input type="date" name="transaction_date" required class="w-full bg-black/40 border border-white/10 text-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 outline-none" style="color-scheme: dark;">
                        </div>
                        <div>
                            <label class="block text-sm text-slate-400 mb-1">Deskripsi (Opsional)</label>
                            <textarea name="description" class="w-full bg-black/40 border border-white/10 text-slate-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 p-2.5 outline-none resize-none" rows="2" placeholder="Gaji bulanan..."></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 rounded-xl transition flex justify-center items-center gap-2">
                            <span x-show="!loading">Simpan Transaksi</span>
                            <span x-show="loading" class="animate-spin w-5 h-5 border-2 border-white/20 border-t-white rounded-full"></span>
                        </button>
                    </form>
                </div>

                {{-- KANAN: CHART.JS (Lebar 2/3) --}}
                <div class="bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10 lg:col-span-2">
                    <h2 class="font-bold text-white text-lg mb-4">Grafik Cashflow</h2>
                    <div class="relative h-[300px] w-full">
                        <canvas id="financeChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- TABEL RIWAYAT TRANSAKSI --}}
            <div class="bg-gray-900/80 backdrop-blur-md p-6 rounded-[24px] shadow-2xl border border-white/10">
                <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
                    <h2 class="font-bold text-white text-lg">Riwayat Transaksi</h2>
                    
                    <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
                        <input type="date" name="start_date" value="{{ request('start_date') }}" class="bg-black/40 border border-white/10 text-slate-200 text-sm rounded-lg px-3 py-1.5" style="color-scheme: dark;">
                        <input type="date" name="end_date" value="{{ request('end_date') }}" class="bg-black/40 border border-white/10 text-slate-200 text-sm rounded-lg px-3 py-1.5" style="color-scheme: dark;">
                        <button type="submit" class="bg-blue-600/20 text-blue-400 border border-blue-500/30 px-3 py-1.5 rounded-lg hover:bg-blue-600/40 transition">Filter</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="text-xs uppercase bg-black/40 text-slate-400">
                            <tr>
                                <th class="px-6 py-3 rounded-tl-lg">Tanggal</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3">Jenis</th>
                                <th class="px-6 py-3">Jumlah</th>
                                <th class="px-6 py-3 rounded-tr-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $t)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition">
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($t->transaction_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4">{{ $t->description ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($t->type == 'pemasukan')
                                        <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2.5 py-0.5 rounded-full text-xs font-medium">Pemasukan</span>
                                    @else
                                        <span class="bg-red-500/10 text-red-400 border border-red-500/20 px-2.5 py-0.5 rounded-full text-xs font-medium">Pengeluaran</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold {{ $t->type == 'pemasukan' ? 'text-emerald-400' : 'text-red-400' }}">
                                    {{ $t->type == 'pemasukan' ? '+' : '-' }}Rp {{ number_format($t->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <form action="{{ route('transactions.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('financeChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pemasukan', 'Pengeluaran'],
                    datasets: [{
                        data: [{{ $pemasukan }}, {{ $pengeluaran }}],
                        backgroundColor: ['#10b981', '#ef4444'], // Emerald & Red
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { color: '#cbd5e1' } }
                    },
                    cutout: '75%'
                }
            });
        });
    </script>
</x-app-layout>