<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NoteCleanerController extends Controller
{
    // Fungsi untuk menampilkan halaman (jika kamu pakai controller untuk load view)
    public function index()
    {
        return view('tools.note-cleaner');
    }

    // Fungsi API untuk request ke Gemini
    public function process(Request $request)
    {
        $request->validate([
            'notes' => 'required|string',
            'format' => 'required|string'
        ]);

        $apiKey = env('GEMINI_API_KEY');
        if (!$apiKey) {
            return response()->json(['message' => 'API Key Gemini belum diatur di .env'], 500);
        }

        // Tentukan instruksi berdasarkan pilihan user
        $instruction = "";
        if ($request->format == 'bullet') {
            $instruction = "Rapikan catatan ini, perbaiki ejaannya, dan buat menjadi poin-poin (bullet points) yang mudah dibaca.";
        } elseif ($request->format == 'formal') {
            $instruction = "Ubah catatan berantakan ini menjadi paragraf yang formal, profesional, dan menggunakan tata bahasa Indonesia yang baku (EYD).";
        } else {
            $instruction = "Buat ringkasan yang padat, jelas, dan singkat dari catatan berikut.";
        }

        // Prompt Master agar AI tidak basa-basi
        $prompt = "Kamu adalah asisten pencatat profesional.

TUGAS:
Ubah CATATAN MENTAH menjadi catatan yang rapi, jelas, dan terstruktur.

ATURAN WAJIB (HARUS DIIKUTI TANPA PENGECUALIAN):
1. Output HANYA isi catatan, tanpa kata pengantar atau penutup apapun.
2. DILARANG menambahkan kalimat seperti 'Ini catatannya', 'Berikut hasilnya', dll.
3. DILARANG menggunakan format markdown seperti **, *, #, atau bold.
4. Gunakan teks biasa (plain text).
5. Gunakan baris baru dan bullet sederhana (-) jika perlu.
6. Jangan menambahkan informasi baru, hanya merapikan isi.
7. Pertahankan bahasa asli dari catatan.
8. Jangan mengubah makna atau konteks.

FORMAT OUTPUT:
- Teks rapi
- Boleh pakai bullet (-)
- Tanpa simbol markdown

CATATAN MENTAH:
{$request->notes}";

        // Tembak API Gemini 1.5 Flash (Model terbaru & tercepat yang direkomendasikan Google)
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey, [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            // Mengekstrak text dari response JSON Gemini
            $resultText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, AI gagal memproses teks ini.';

            return response()->json(['result' => trim($resultText)]);
        }

        $response = Http::withoutVerifying()->withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey, [
            'contents' => [
                ['parts' => [['text' => $prompt]]]
            ]
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $resultText = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, AI gagal memproses teks ini.';

            return response()->json(['result' => trim($resultText)]);
        }

        // Ini akan menampilkan alasan ASLI kenapa Google menolak request kita
        return response()->json([
            'message' => 'Error Google: ' . $response->body()
        ], 500);

        return response()->json(['message' => 'Gagal menghubungi server AI'], 500);
    }
}
