<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user yang sedang login adalah admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request); // Izinkan akses ke route berikutnya
        }

        // jika bukan admin, logout user dan redirect ke halaman login
        auth()->logout();
        return redirect('/login');
    }
}