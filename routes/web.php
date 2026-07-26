<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LicenseController;
use App\Http\Middleware\EnsureUserLoggedIn;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('convert.index');
});

Route::get('/download', [DownloadController::class, 'index'])->name('download');

Route::get('/pricing', [LicenseController::class, 'pricing'])->name('pricing');

Route::middleware(RedirectIfAuthenticated::class)->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(EnsureUserLoggedIn::class);

Route::middleware(EnsureUserLoggedIn::class)->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $licenses = $user->licenses()->latest()->get();
        return view('dashboard.index', compact('licenses'));
    })->name('dashboard');

    Route::get('/convert', [ConversionController::class, 'index'])->name('convert.index');
    Route::post('/convert', [ConversionController::class, 'store'])->name('convert.store');
    Route::get('/convert/{conversion:uuid}', [ConversionController::class, 'show'])->name('convert.show');
    Route::get('/convert/{conversion:uuid}/download', [ConversionController::class, 'download'])->name('convert.download');
    Route::delete('/convert/{conversion:uuid}', [ConversionController::class, 'destroy'])->name('convert.destroy');

    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses');
    Route::get('/licenses/{license:license_key}', [LicenseController::class, 'show'])->name('licenses.show');
    Route::get('/checkout/{plan}', [LicenseController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{plan}', [LicenseController::class, 'processCheckout'])->name('checkout.process');
});
