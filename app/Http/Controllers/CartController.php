<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CartServiceInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartServiceInterface $cartService) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $this->cartService->addToCart($request->product_id, $request->quantity);
        return redirect()->route('cart.index')->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function update(Request $request)
    {
        $this->cartService->updateQuantity($request->product_id, $request->quantity);
        return back();
    }

    public function remove($productId)
    {
        $this->cartService->removeFromCart($productId);
        return back();
    }

    public function clear()
    {
        $this->cartService->clearCart();
        return back();
    }
}



