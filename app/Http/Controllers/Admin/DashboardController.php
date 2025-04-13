<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Models\User;

class DashboardController extends Controller
{
    protected $productService;
    protected $orderService;

    public function __construct(ProductServiceInterface $productService, OrderServiceInterface $orderService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $productCount = $this->productService->count();
        $orderCount = $this->orderService->count();
        $userCount = User::count(); // Hoặc dùng UserRepository nếu bạn đã tạo

        return view('admin.dashboard', compact('productCount', 'orderCount', 'userCount'));
    }
}

