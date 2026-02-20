<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        // 2. Cek apakah kolom is_admin bernilai true (1)
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Jika bukan admin, tendang ke halaman login user atau home
        // Kamu bisa tambahkan pesan error via session
        return redirect('/login')->with('error', 'Anda tidak memiliki akses admin.');
    }
}