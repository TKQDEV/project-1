<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống');

        $this->orderService->createFromCart($cart, Auth::id());

        session()->forget('cart');
        return redirect()->route('orders.my')->with('success', 'Đơn hàng đã được đặt!');
    }

    public function myOrders()
    {
        $orders = $this->orderService->getOrdersByUser(Auth::id());
        return view('orders.my', compact('orders'));
    }

    public function index()
    {
        $orders = $this->orderService->getAll();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus($id)
    {
        $this->orderService->updateStatus($id, request('status'));
        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}

