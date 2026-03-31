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

    // 1. Mengambil Jadwal Selanjutnya (KUNCI DI ID: 4790 LIGA 1 INDONESIA)
    public function leagueUpcoming()
    {
        return $this->fetchFromSportsDB('eventsnextleague.php', ['id' => '4790'])->json();
    }

    // 2. Mengambil Hasil Terakhir (KUNCI DI ID: 4790 LIGA 1 INDONESIA)
    public function leaguePast()
    {
        return $this->fetchFromSportsDB('eventspastleague.php', ['id' => '4790'])->json();
    }

    // 3. Mengambil Daftar Seluruh Klub (KUNCI DI ID: 4790 LIGA 1 INDONESIA)
    public function leagueTeams()
    {
        return $this->fetchFromSportsDB('lookup_all_teams.php', ['id' => '4790'])->json();
    }
}