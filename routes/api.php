<?php

use App\Http\Controllers\Api\ApiConversionController;
use App\Http\Controllers\Api\ApiLicenseController;
use App\Http\Controllers\Api\ApiVersionController;
use Illuminate\Support\Facades\Route;

Route::post('/convert', [ApiConversionController::class, 'store'])->name('api.convert.store');
Route::get('/convert/{uuid}/status', [ApiConversionController::class, 'status'])->name('api.convert.status');
Route::get('/convert/{uuid}/download', [ApiConversionController::class, 'download'])->name('api.convert.download');

Route::post('/license/verify', [ApiLicenseController::class, 'verify'])->name('api.license.verify');

Route::get('/version', [ApiVersionController::class, 'check'])->name('api.version.check');
