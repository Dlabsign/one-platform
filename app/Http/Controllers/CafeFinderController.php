<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CafeFinderController extends Controller
{
    public function index()
    {
        return view('tools.cafe-finder');
    }

    public function process(Request $request)
    {
        $request->validate([
            'preferences' => 'required|string',
            'city' => 'required|string',
            'price' => 'nullable|integer|between:1,3',
        ]);

        $geminiKey = env('GEMINI_API_KEY');

        if (!$geminiKey) {
            return response()->json(['message' => 'API Key Gemini belum diatur di .env'], 500);
        }

        try {
            // =========================
            // 1. GEMINI AI
            // =========================
            $prompt = "User mencari: {$request->preferences}. 
            Buat 1 keyword singkat dalam bahasa inggris untuk mencari cafe.
            Output JSON: {\"keywords\":\"cafe\"}";

            $geminiResponse = Http::withoutVerifying()->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $geminiKey,
                [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ]
            );

            if (!$geminiResponse->successful()) {
                throw new \Exception('Gemini API Error: ' . $geminiResponse->body());
            }

            $aiText = $geminiResponse->json()['candidates'][0]['content']['parts'][0]['text'] ?? '{"keywords":"cafe"}';
            $filters = json_decode(preg_replace('/```json|```/', '', $aiText), true);

            // =========================
            // 2. NOMINATIM API: Cari Pusat Kota
            // =========================
            $cityResponse = Http::withHeaders(['User-Agent' => 'CafeFinderApp/1.0'])
                ->withoutVerifying()
                ->get('https://nominatim.openstreetmap.org/search', [
                    'format' => 'jsonv2',
                    'q' => $request->city,
                    'limit' => 1
                ]);
            
            $cityData = $cityResponse->json();
            
            if (empty($cityData)) {
                throw new \Exception("Kota '{$request->city}' tidak ditemukan di Peta.");
            }
            
            $cityLat = $cityData[0]['lat'];
            $cityLon = $cityData[0]['lon'];

            // =========================
            // 3. NOMINATIM API: Cari Kafe + Extra Tags (Jam Buka)
            // =========================
            $cafeResponse = Http::withHeaders(['User-Agent' => 'CafeFinderApp/1.0'])
                ->withoutVerifying()
                ->get('https://nominatim.openstreetmap.org/search', [
                    'format' => 'jsonv2',
                    'q' => 'cafe in ' . $request->city,
                    'limit' => 25,
                    'extratags' => 1 // <--- Meminta data tambahan seperti Jam Buka
                ]);

            if (!$cafeResponse->successful()) {
                throw new \Exception('Gagal mengambil data dari server Peta Nominatim.');
            }

            $rawCafes = $cafeResponse->json();

            // =========================
            // 4. PROCESS DATA
            // =========================
            $processedCafes = [];

            foreach ($rawCafes as $cafe) {
                $name = $cafe['name'] ?? null;
                if (!$name || strtolower($name) === strtolower($request->city)) continue; 

                $cLat = $cafe['lat'];
                $cLon = $cafe['lon'];

                $distKm = $this->calculateDistance($cityLat, $cityLon, $cLat, $cLon);
                $address = str_replace($name . ', ', '', $cafe['display_name']);

                // Mengambil Jam Buka dari OSM jika ada
                $extraTags = $cafe['extratags'] ?? [];
                $openingHours = $extraTags['opening_hours'] ?? 'Jam buka tidak tersedia di data OSM';

                // Karena OSM tidak punya Rating, kita buat Mock Rating (4.0 - 4.9) yang konsisten berdasarkan ID
                $mockRating = 4.0 + (intval(substr($cafe['place_id'], -1)) / 10);

                $processedCafes[] = [
                    'place_id' => $cafe['place_id'],
                    'name' => $name,
                    'vicinity' => $address,
                    'opening_hours' => $openingHours, // Tambahan Jam Buka
                    'rating' => number_format($mockRating, 1), // Tambahan Rating
                    'geometry' => [
                        'location' => [
                            'lat' => (float) $cLat,
                            'lng' => (float) $cLon
                        ]
                    ],
                    'distance_km' => $distKm,
                    'distance_text' => $distKm < 1 
                        ? round($distKm * 1000) . ' m dari pusat kota' 
                        : round($distKm, 1) . ' km dari pusat kota',
                ];
            }

            usort($processedCafes, fn($a, $b) => $a['distance_km'] <=> $b['distance_km']);

            return response()->json([
                'city_center' => ['lat' => (float) $cityLat, 'lng' => (float) $cityLon], 
                'cafes' => array_slice($processedCafes, 0, 10)
            ]);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        return $earthRadius * (2 * atan2(sqrt($a), sqrt(1 - $a)));
    }
}