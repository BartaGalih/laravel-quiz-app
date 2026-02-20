<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::get('/', function () {
    return view('welcome');
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
