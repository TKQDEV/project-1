<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(protected OrderServiceInterface $orderService) {}

    public function store()
    {
        $cart = session()->get('cart', []);
        $this->orderService->createOrder(Auth::id(), $cart);
        session()->forget('cart');
        return redirect()->route('user.orders.index')->with('success', 'Đã đặt hàng thành công!');
    }

    public function index()
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        return view('user.orders.index', compact('orders'));
    }
}


