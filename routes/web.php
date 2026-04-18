<?php

use App\Http\Controllers\BmkgController;
use App\Http\Controllers\CafeFinderController;
use App\Http\Controllers\CariKataController;
use App\Http\Controllers\NoteCleanerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SepakBolaController;
use App\Http\Controllers\WeatherController;

Route::get('/', [PdfController::class, 'index'])->name('home');

// PDF CONVERSION
// Route::get('/tools/word-to-pdf', [PdfController::class, 'showWordToPdf'])->name('tools.wordPdf');
// Route::post('/convert/word-to-pdf', [PdfController::class, 'wordToPdf'])->name('convert.wordToPdf');

Route::post('/convert/image-to-pdf', [PdfController::class, 'imageToPdf'])->name('convert.imageToPdf');
Route::get('/tools/merge-pdf', [PdfController::class, 'showMergePdf'])->name('tools.mergePdf');
Route::post('/convert/merge-pdf', [PdfController::class, 'mergePdf'])->name('convert.mergePdf');
Route::get('/tools/image-pdf', [PdfController::class, 'showImagePdf'])->name('tools.imagePdf');

Route::get('/tools/note-cleaner', function () {
    return view('tools.note-cleaner');
})->name('tools.noteCleaner');
Route::post('/api/tools/note-cleaner', [NoteCleanerController::class, 'process'])->name('tools.processNotes');

// Podomoro
Route::get('/tools/pomodoro', function () {
    return view('tools.pomodoro');
})->name('tools.pomodoro');

Route::get('/tools/cafe-finder', [CafeFinderController::class, 'index'])->name('tools.cafeFinder');
Route::post('/api/tools/cafe-finder', [CafeFinderController::class, 'process'])->name('tools.processCafeFinder');

Route::get('/tools/cari-kata', [CariKataController::class, 'index'])->name('tools.cariKata');
// Route untuk memproses API di Backend
Route::post('/api/tools/cari-kata', [CariKataController::class, 'process'])->name('tools.processCariKata');

Route::get('/tools/movies-recomendation', function () {
    return view('tools.movies-recomendation');
})->name('tools.movies-recomendation');

// === FINANCIAL TOOLS ===

// Live Metals Tracker
Route::get('/tools/gold-check', function () {
    return view('tools.gold-check');
})->name('tools.goldCheck');

// Live Crypto Tracker
Route::get('/tools/crypto-tracker', function () {
    return view('tools.crypto-tracker');
})->name('tools.cryptoTracker');


// === SEPAK BOLA ===

Route::get('/tools/sepak-bola', [SepakBolaController::class, 'index'])->name('tools.sepakBola');

// Route API Lokal Sepak Bola
Route::get('/api/tools/sepak-bola/league-schedule', [SepakBolaController::class, 'leagueSchedule']);
Route::get('/api/tools/sepak-bola/league-teams', [SepakBolaController::class, 'leagueTeams']);
Route::get('/api/tools/sepak-bola/team-detail', [SepakBolaController::class, 'teamDetail']);
Route::get('/api/tools/sepak-bola/team-past', [SepakBolaController::class, 'teamPast']);
Route::get('/api/tools/sepak-bola/team-upcoming', [SepakBolaController::class, 'teamUpcoming']);

// === BMKG & CUACA ===

Route::get('/tools/weather', [BmkgController::class, 'weather'])->name('tools.weather');
Route::get('/tools/gempa', [BmkgController::class, 'gempa'])->name('tools.gempa');

