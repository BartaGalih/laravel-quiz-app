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
        // set guard to admin guard
        Auth::shouldUse('admin');
        // 1. Cek apakah user sudah login
        if (Auth::check()) {
            return $next($request);
        }

        // if not an admin session, redirect to the admin login page
        return redirect()->route('admin.login');
    }
}