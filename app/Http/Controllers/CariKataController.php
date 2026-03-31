<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CariKataController extends Controller
{
    public function index()
    {
        return view('tools.cari-kata');
    }

    public function process(Request $request)
    {
        $request->validate([
            'word' => 'required|string|max:100',
        ]);

        $word = urlencode(strtolower(trim($request->word)));

        try {
            // Menggunakan URL sesuai dokumentasi API X-Labs
            $response = Http::withoutVerifying()
                ->timeout(15)
                ->get("https://openapi.x-labs.my.id/kbbi?search={$word}");

            if (!$response->successful()) {
                throw new \Exception('Gagal terhubung ke server KBBI.');
            }

            $data = $response->json();

            // Jika API merespons dengan status false atau data kosong
            if (empty($data['data']) || $data['success'] === false) {
                return response()->json([
                    'success' => false,
                    'message' => "Kata '{$request->word}' tidak ditemukan di KBBI."
                ]);
            }

            return response()->json([
                'success' => true,
                'result' => $data['data']
            ]);
        } catch (\Exception $e) {
            Log::error('KBBI Search Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem atau server API sedang down.'
            ], 500);
        }
    }
}
