<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$role
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Pastikan pengguna sudah terautentikasi dan memiliki peran yang sesuai
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        // Jika tidak memiliki peran yang sesuai, logout dan arahkan ke halaman login
        Auth::logout();
        return redirect()->route('login')->with('status', 'You are not authorized to access this page.');
    }
}

