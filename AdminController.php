<?php

namespace App\Http\Controllers;

use App\Services\CategoryServiceInterface;
use App\Services\ProductServiceInterface;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class AdminController extends Controller
{
    protected $categoryService;
    protected $productService;
    protected $orderService;

    public function __construct(
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        OrderServiceInterface $orderService
    ) {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
        $this->orderService = $orderService;
    }

    // Quản lý danh mục
    public function indexCategories()
    {
        $categories = Category::getCategoryTree(); // Lấy cấu trúc cây của danh mục
        return view('admin.categories.index', compact('categories'));
    }
    

    public function createCategory()
    {
        return view('admin.categories.create');
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->create($data);
        return redirect()->route('admin.categories.index');
    }

    public function editCategory($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->categoryService->updateCategory($id, $data);
        return redirect()->route('admin.categories.index');
    }

    public function deleteCategory($id)
    {
        $this->categoryService->deleteCategory($id);
        return redirect()->route('admin.categories.index');
    }

    // Quản lý sản phẩm
    public function indexProducts()
    {
        $products = $this->productService->getAllProducts();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        // Validate dữ liệu
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'images' => 'required|array', // Đảm bảo rằng có ảnh được chọn
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Kiểm tra ảnh hợp lệ
        ]);
    
        // Tạo sản phẩm mới
        $product = $this->productService->create($data);
    
        // Lưu trữ các ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Lưu ảnh vào storage
                $path = $image->store('products', 'public'); // Lưu ảnh vào thư mục public/products
    
                // Lưu thông tin ảnh vào bảng product_images
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
    
        return redirect()->route('admin.products.index');
    }

    public function editProduct($id)
    {
        $product = $this->productService->getProductById($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $this->productService->updateProduct($id, $data);
        return redirect()->route('admin.products.index');
    }

    public function deleteProduct($id)
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('admin.products.index');
    }

    // Quản lý đơn hàng
    public function indexOrders()
    {
        $orders = $this->orderService->getOrdersByUserId(Auth::user()->id);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $this->orderService->updateOrderStatus($id, $data);
        return redirect()->route('admin.orders.index');
    }

    public function dashboard()
    {
        // Lấy tổng số người dùng
        $totalUsers = User::count();

        // Lấy tổng số sản phẩm
        $totalProducts = Product::count();

        // Lấy tổng số đơn hàng
        $totalOrders = Order::count();

        // Lấy tổng số danh mục
        $totalCategories = $this->categoryService->getAllCategories()->count();

        // Truyền các dữ liệu vào view dashboard
        return view('admin.dashboard', compact('totalUsers', 'totalProducts', 'totalOrders', 'totalCategories'));
    }
}
