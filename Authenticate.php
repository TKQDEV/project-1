<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login'); // Đây là URL chuyển hướng khi người dùng chưa đăng nhập
        }
    }
    
}