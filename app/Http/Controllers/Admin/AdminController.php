<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\OrderServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // View admin dashboard
    }


    protected $productService, $orderService, $categoryService;

    public function __construct(
        ProductServiceInterface $productService,
        OrderServiceInterface $orderService,
        CategoryServiceInterface $categoryService
    ) {
        $this->productService = $productService;
        $this->orderService = $orderService;
        $this->categoryService = $categoryService;
    }

    public function dashboard()
{
    $userCount = User::count();
    $orderCount = Order::count();
    $productCount = Product::count();

    // Tổng doanh thu từ đơn hàng đã hoàn thành
    $totalRevenue = Order::where('status', 'completed')->sum('total');

    // Lấy 5 đơn hàng mới nhất
    $latestOrders = Order::with('user')->orderByDesc('created_at')->take(5)->get();

    return view('admin.dashboard', compact(
        'userCount', 'orderCount', 'productCount', 'totalRevenue', 'latestOrders'
    ));

    return view('admin.dashboard'); // View admin dashboard

}


}

