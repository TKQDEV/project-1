<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->role !== 'admin') {
                return view('layouts.user');
            } else {
                return view('layouts.admin');
            }
        }
        
        return view('welcome');
    }
}

