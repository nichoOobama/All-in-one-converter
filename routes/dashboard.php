<?php

use App\Http\Middleware\EnsureUserLoggedIn;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

Route::middleware(EnsureUserLoggedIn::class)->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $licenses = $user->licenses()->latest()->get();

        return view('dashboard.index', compact('licenses'));
    })->name('dashboard');
});
