<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class basicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return session('username') !== null
            ? $next($request)
            : redirect('/')->with('session-expired', 'karena tidak ada aktivitas dalam 3 jam harus login kembali');
    }
}
