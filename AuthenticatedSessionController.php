<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            // Nếu đăng nhập thành công, kiểm tra vai trò của người dùng và điều hướng
            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect()->route('layouts.admin'); 
            } else {
                return redirect()->route('layouts.user');
            }
        }

        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */

     public function destroy(Request $request)
     {
         // Kiểm tra nếu người dùng đã đăng nhập
         if (Auth::check()) {
             Auth::logout();  // Đăng xuất người dùng hiện tại
 
             // Xóa tất cả session và token bảo mật
             $request->session()->invalidate();
             $request->session()->regenerateToken();
         }
 
         // Chuyển hướng về trang đăng nhập với thông báo
         return redirect()->route('login')->with('status', 'Bạn đã đăng xuất thành công!');
     }
}
