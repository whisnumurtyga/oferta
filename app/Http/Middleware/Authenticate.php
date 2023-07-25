<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!(Auth::check())) {
            // Jika pengguna sudah login, arahkan mereka ke halaman dashboard atau halaman lainnya
            return redirect()->route('login'); // Ganti 'dashboard' dengan nama rute halaman dashboard Anda
        }
        return $next($request);
    }
}
