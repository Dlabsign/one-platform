<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    // Mengambil URL Firebase dari .env
    private function getFirebaseUrl($path = '')
    {
        return env('FIREBASE_URL') . '/transactions/' . Auth::id() . $path . '.json';
    }

    public function index(Request $request)
    {
        // 1. Ambil semua data transaksi milik user ini dari Firebase
        $response = Http::get($this->getFirebaseUrl());
        $data = $response->json() ?? [];

        $transactions = [];
        $pemasukan = 0;
        $pengeluaran = 0;

        // 2. Format data dari object Firebase menjadi Array
        foreach ($data as $firebaseKey => $val) {
            $val['id'] = $firebaseKey; // Simpan ID unik dari Firebase

            // Filter berdasarkan tanggal (jika form filter diisi)
            if ($request->filled('start_date') && $request->filled('end_date')) {
                if ($val['transaction_date'] < $request->start_date || $val['transaction_date'] > $request->end_date) {
                    continue; // Lewati jika tidak masuk rentang tanggal
                }
            }

            $transactions[] = $val;

            // Hitung ringkasan Dashboard
            if ($val['type'] == 'pemasukan') {
                $pemasukan += $val['amount'];
            } else {
                $pengeluaran += $val['amount'];
            }
        }

        // 3. Urutkan transaksi dari yang terbaru ke terlama
        usort($transactions, function ($a, $b) {
            return strtotime($b['transaction_date']) - strtotime($a['transaction_date']);
        });

        $saldo = $pemasukan - $pengeluaran;

        return view('tools.finance-dashboard', compact('transactions', 'pemasukan', 'pengeluaran', 'saldo'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric|min:1',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        // Siapkan Payload Data
        $payload = [
            'type' => $request->type,
            'amount' => (float) $request->amount,
            'transaction_date' => $request->transaction_date,
            'description' => $request->description,
            'created_at' => now()->toDateTimeString(),
        ];

        // POST data ke Firebase (Otomatis membuat unique key/ID)
        Http::post($this->getFirebaseUrl(), $payload);

        // Jika Anda masih ingin mengirim email, panggil script Email di sini
        // Mail::to(Auth::user()->email)->send(new TransactionSaved($payload));

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan ke Firebase!');
    }

    public function destroy($id)
    {
        // Hapus data spesifik berdasarkan Firebase Key (ID)
        Http::delete($this->getFirebaseUrl('/' . $id));

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus dari Firebase.');
    }
}
