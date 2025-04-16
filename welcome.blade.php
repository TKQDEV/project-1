{{-- Chọn layout chính dùng chung hoặc theo vai trò --}}
@extends(auth()->check() && auth()->user()->role === 'admin' ? 'layouts.admin' : (auth()->check() && auth()->user()->role === 'user' ? 'layouts.user' : 'layouts.app'))

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center space-y-6">
        <h1 class="text-4xl font-extrabold text-indigo-600">Chào mừng đến với E-Commerce</h1>

        @auth
            <div class="text-center">
                <p class="text-lg">Xin chào, <span class="font-semibold text-xl">{{ auth()->user()->name }}</span>!</p>
                <p class="text-lg">Bạn đã đăng nhập thành công.</p>
            </div>
        @else
            <p class="text-lg mt-6">Vui lòng đăng nhập hoặc đăng ký để bắt đầu mua sắm.</p>
            <div class="space-x-4 mt-4">
                <a href="{{ route('login') }}" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Đăng nhập</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Đăng ký</a>
            </div>
        @endauth
    </div>
@endsection
