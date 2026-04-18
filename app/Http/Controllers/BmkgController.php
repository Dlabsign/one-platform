<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BmkgController extends Controller
{
    public function gempa()
    {
        $url = 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json';
        $gempaData = null;

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();
                $gempaData = $data['Infogempa']['gempa'] ?? null;
            }
        } catch (\Exception $e) {
            // optional: log error
        }

        return view('tools.gempa', compact('gempaData'));
    }

    public function weather(Request $request)
    {
        // 1. Parameter wilayah
        $kodeWilayah = $request->get('wilayah', '35.15.08.2001');

        // 2. Parameter GPS
        $lat = $request->get('lat', '-7.4478');
        $lon = $request->get('lon', '112.7183');

        // 3. API BMKG
        $responseBmkg = Http::get("https://api.bmkg.go.id/publik/prakiraan-cuaca", [
            'adm4' => $kodeWilayah
        ]);

        $weatherData = $responseBmkg->successful()
            ? $responseBmkg->json()
            : null;

        // 4. API Open-Meteo
        $responseRain = Http::get("https://api.open-meteo.com/v1/forecast", [
            'latitude' => $lat,
            'longitude' => $lon,
            'daily' => 'precipitation_sum',
            'past_days' => 3,
            'forecast_days' => 2,
            'timezone' => 'Asia/Jakarta'
        ]);

        $rainData = $responseRain->successful()
            ? $responseRain->json()
            : null;

        return view('tools.weather', compact('weatherData', 'rainData'));
    }
}
