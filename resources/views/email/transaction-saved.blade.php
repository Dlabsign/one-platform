<p>Halo,</p>
<p>Transaksi Anda telah berhasil dicatat dengan rincian berikut:</p>
<ul>
    <li><strong>Jenis:</strong> {{ ucfirst($transaction->type) }}</li>
    <li><strong>Jumlah:</strong> Rp {{ number_format($transaction->amount, 0, ',', '.') }}</li>
    <li><strong>Tanggal:</strong> {{ $transaction->transaction_date }}</li>
    <li><strong>Deskripsi:</strong> {{ $transaction->description ?? '-' }}</li>
</ul>
<p>Terima kasih,</p>
<p>Personal Finance App</p>