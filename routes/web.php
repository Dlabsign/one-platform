<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;

Route::get('/', [PdfController::class, 'index'])->name('home');

// PDF CONVERSION
Route::get('/tools/word-to-pdf', [PdfController::class, 'showWordToPdf'])->name('tools.wordPdf');
Route::post('/convert/word-to-pdf', [PdfController::class, 'wordToPdf'])->name('convert.wordToPdf');
Route::post('/convert/image-to-pdf', [PdfController::class, 'imageToPdf'])->name('convert.imageToPdf');
Route::get('/tools/merge-pdf', [PdfController::class, 'showMergePdf'])->name('tools.mergePdf');
Route::post('/convert/merge-pdf', [PdfController::class, 'mergePdf'])->name('convert.mergePdf');
Route::get('/tools/image-pdf', [PdfController::class, 'showImagePdf'])->name('tools.imagePdf');

// Podomoro
Route::get('/tools/pomodoro', function () {
    return view('tools.pomodoro');
})->name('tools.pomodoro');