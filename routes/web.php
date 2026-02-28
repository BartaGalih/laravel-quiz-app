<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// User authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserAuthController::class, 'login'])->name('login.post');
});

// Protected user area
Route::middleware('auth')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
});


Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Admin (Belum Login)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Protected Admin (Hanya Admin yang bisa masuk)
    // Kita pakai middleware 'auth' bawaan Laravel DAN 'admin' buatan kita
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); 
        })->name('dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
