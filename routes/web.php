<?php

use App\Http\Controllers\CafeFinderController;
use App\Http\Controllers\CariKataController;
use App\Http\Controllers\NoteCleanerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SepakBolaController;

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

// Sepak Bola


// Rute Halaman
Route::get('/tools/sepak-bola', [SepakBolaController::class, 'index'])->name('tools.sepakBola');

Route::get('/api/tools/sepak-bola/search-team', [SepakBolaController::class, 'searchTeam']);
Route::get('/api/tools/sepak-bola/last-matches', [SepakBolaController::class, 'lastMatches']);
Route::get('/api/tools/sepak-bola/next-matches', [SepakBolaController::class, 'nextMatches']);
Route::get('/api/tools/sepak-bola/players', [SepakBolaController::class, 'searchPlayers']);
Route::get('/api/tools/sepak-bola/league-upcoming', [SepakBolaController::class, 'leagueUpcoming']);
Route::get('/api/tools/sepak-bola/league-past', [SepakBolaController::class, 'leaguePast']);
Route::get('/api/tools/sepak-bola/league-teams', [SepakBolaController::class, 'leagueTeams']);