<?php

namespace App\Http\Controllers;

use App\Services\ProductServiceInterface;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class UserController extends Controller
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
        return view('user.dashboard');  // View cho user dashboard
    }

    // Xem danh sách sản phẩm
    public function indexProducts(Request $request)
    {
        $query = Product::query();
    
        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        $products = $query->paginate(10); // Sử dụng phân trang
    
        return view('user.products.index', compact('products'));
    }
    

    // Xem chi tiết sản phẩm
    public function showProduct($id)
    {
        $product = $this->productService->getProductById($id);
        return view('user.products.show', compact('product'));
    }

    // Thêm sản phẩm vào giỏ hàng có thể lưu trực tiếp vào session
    
    public function addProductToCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $product = $this->productService->getProductById($productId);
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('user.cart')->with('success', 'Product added to cart successfully!');
    }
    


    // Xem giỏ hàng từ session
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('user.cart.index', compact('cart'));
    }
    // Xóa sản phẩm khỏi giỏ hàng
    public function removeProductFromCart($productId)
    {
        $cart = session()->get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('user.cart')->with('success', 'Product removed from cart successfully!');
    }
    // Tạo đơn hàng
    public function createOrder(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $order = $this->orderService->createOrder($data);
        return redirect()->route('user.orders.index');
    }

    // Xem lịch sử đơn hàng
    public function indexOrders()
    {
        $orders = $this->orderService->getOrdersByUserId(Auth::user()->id);
        return view('user.orders.index', compact('orders'));
    }
}
