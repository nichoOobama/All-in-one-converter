<?php

use App\Http\Controllers\ConversionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('convert.index');
});

Route::get('/convert', [ConversionController::class, 'index'])->name('convert.index');
Route::post('/convert', [ConversionController::class, 'store'])->name('convert.store');
Route::get('/convert/{conversion:uuid}', [ConversionController::class, 'show'])->name('convert.show');
Route::get('/convert/{conversion:uuid}/download', [ConversionController::class, 'download'])->name('convert.download');
Route::delete('/convert/{conversion:uuid}', [ConversionController::class, 'destroy'])->name('convert.destroy');
