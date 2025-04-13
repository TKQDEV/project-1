<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Http\Request;
use App\Models\Order; // Assuming you have an Order model

class AdminOrderController extends Controller
{
    public function __construct(protected OrderServiceInterface $orderService) {}

    public function index()
    {
        $orders = $this->orderService->getAll();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $this->orderService->updateStatus($id, $request->status);
        return back()->with('success', 'Cập nhật trạng thái thành công');
    }

    public function show($id)
{
    $order = Order::with('items.product')->findOrFail($id);
    return view('admin.orders.show', compact('order'));
}


}
