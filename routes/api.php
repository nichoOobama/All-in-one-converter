<?php

use App\Http\Controllers\Api\ApiConversionController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::post('/convert', [ApiConversionController::class, 'store'])->name('api.convert.store');
    Route::get('/convert/{uuid}/status', [ApiConversionController::class, 'status'])->name('api.convert.status');
    Route::get('/convert/{uuid}/download', [ApiConversionController::class, 'download'])->name('api.convert.download');
});
