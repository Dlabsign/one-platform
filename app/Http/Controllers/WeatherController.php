<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        $kodeWilayah = '31.71.01.1001'; 
        $response = Http::get("https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4={$kodeWilayah}");
        
        $weatherData = $response->successful() ? $response->json() : null;

        // Pastikan nama view-nya adalah 'tools.weather'
        return view('tools.weather', compact('weatherData'));
    }
}