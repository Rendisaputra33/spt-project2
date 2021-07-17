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
        return session('id_user') !== null
            ? $next($request)
            : redirect()->back()->with('unauthorize');
    }
}
