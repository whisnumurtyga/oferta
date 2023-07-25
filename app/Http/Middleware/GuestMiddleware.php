<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Jika pengguna sudah diautentikasi, arahkan ke halaman dashboard (misalnya)
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
