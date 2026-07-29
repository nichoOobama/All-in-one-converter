<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminConversionController;
use App\Http\Controllers\Admin\AdminLicenseController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVersionController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\LicenseController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserLoggedIn;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/convert', [ConversionController::class, 'index'])->name('convert.index');
Route::post('/convert', [ConversionController::class, 'store'])->name('convert.store');
Route::get('/convert/{conversion:uuid}', [ConversionController::class, 'show'])->name('convert.show');
Route::get('/convert/{conversion:uuid}/download', [ConversionController::class, 'download'])->name('convert.download');
Route::delete('/convert/{conversion:uuid}', [ConversionController::class, 'destroy'])->name('convert.destroy');


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

    Route::get('/licenses', [LicenseController::class, 'index'])->name('licenses');
    Route::get('/licenses/{license:license_key}', [LicenseController::class, 'show'])->name('licenses.show');
    Route::get('/checkout/{plan}', [LicenseController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{plan}', [LicenseController::class, 'processCheckout'])->name('checkout.process');
});

Route::prefix('admin')->name('admin.')->middleware(EnsureUserIsAdmin::class)->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
    Route::patch('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/conversions', [AdminConversionController::class, 'index'])->name('conversions.index');
    Route::get('/conversions/{conversion}', [AdminConversionController::class, 'show'])->name('conversions.show');
    Route::delete('/conversions/{conversion}', [AdminConversionController::class, 'destroy'])->name('conversions.destroy');

    Route::get('/licenses', [AdminLicenseController::class, 'index'])->name('licenses.index');
    Route::get('/licenses/create', [AdminLicenseController::class, 'create'])->name('licenses.create');
    Route::post('/licenses', [AdminLicenseController::class, 'store'])->name('licenses.store');
    Route::get('/licenses/{license}', [AdminLicenseController::class, 'show'])->name('licenses.show');
    Route::delete('/licenses/{license}', [AdminLicenseController::class, 'destroy'])->name('licenses.destroy');

    Route::get('/versions', [AdminVersionController::class, 'index'])->name('versions.index');
    Route::get('/versions/create', [AdminVersionController::class, 'create'])->name('versions.create');
    Route::post('/versions', [AdminVersionController::class, 'store'])->name('versions.store');
    Route::get('/versions/{version}/edit', [AdminVersionController::class, 'edit'])->name('versions.edit');
    Route::put('/versions/{version}', [AdminVersionController::class, 'update'])->name('versions.update');
    Route::delete('/versions/{version}', [AdminVersionController::class, 'destroy'])->name('versions.destroy');

    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
