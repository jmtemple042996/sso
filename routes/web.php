<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProviderController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('auth')->name('auth.')->group(function() {
    Route::prefix('external/{provider}')->name('external.')->group(function() {
        Route::get('redirect', [ProviderController::class, 'redirect'])->name('redirect');
        Route::get('handle', [ProviderController::class, 'handle'])->name('handle');
        Route::get('unlink', [ProviderController::class, 'unlink'])->name('unlink');
    });
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
