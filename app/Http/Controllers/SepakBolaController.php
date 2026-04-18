<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SepakBolaController extends Controller
{
    private $apiKey = '123';
    private $baseUrl = 'https://www.thesportsdb.com/api/v1/json/';

    public function index()
    {
        return view('tools.sepak-bola');
    }

    private function fetchFromSportsDB($endpoint, $params = [])
    {
        try {
            return Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Accept' => 'application/json'
            ])
                ->withoutVerifying()
                ->get($this->baseUrl . $this->apiKey . '/' . $endpoint, $params);
        } catch (\Exception $e) {
            Log::error('TheSportsDB Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal terhubung ke API'], 500);
        }
    }

    // ==========================================
    // API UNTUK DASHBOARD UTAMA
    // ==========================================

    public function leagueSchedule()
    {
        // 1. Tarik dari Endpoint spesifik Next dan Past agar tidak terjebak di musim lama
        $resUpcoming = $this->fetchFromSportsDB('eventsnextleague.php', ['id' => '4790']);
        $resPast = $this->fetchFromSportsDB('eventspastleague.php', ['id' => '4790']);

        // 2. Terjemahkan ke Array. Jika dari server pusat kosong (null), paksa jadi array kosong []
        $upcomingData = method_exists($resUpcoming, 'json') ? ($resUpcoming->json()['events'] ?? []) : [];
        $pastData = method_exists($resPast, 'json') ? ($resPast->json()['events'] ?? []) : [];

        // 3. Kembalikan maksimal 15 data teratas
        return response()->json([
            'upcoming' => array_slice($upcomingData ?: [], 0, 15),
            'past' => array_slice($pastData ?: [], 0, 15)
        ]);
    }
    
    public function leagueTeams()
    {
        return $this->fetchFromSportsDB('search_all_teams.php', ['l' => 'Indonesian Super League'])->json();
    }

    // ==========================================
    // API UNTUK MODAL DETAIL KLUB
    // ==========================================

    public function teamDetail(Request $request)
    {
        $res = $this->fetchFromSportsDB('lookupteam.php', ['id' => $request->id]);
        $data = method_exists($res, 'json') ? $res->json() : [];
        return response()->json($data ?: ['teams' => []]);
    }

    public function teamPast(Request $request)
    {
        $res = $this->fetchFromSportsDB('eventslast.php', ['id' => $request->id]);
        $data = method_exists($res, 'json') ? $res->json() : [];
        return response()->json($data ?: ['results' => []]);
    }

    public function teamUpcoming(Request $request)
    {
        $res = $this->fetchFromSportsDB('eventsnext.php', ['id' => $request->id]);
        $data = method_exists($res, 'json') ? $res->json() : [];
        return response()->json($data ?: ['events' => []]);
    }
}
