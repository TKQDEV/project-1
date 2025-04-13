<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('user.cart.index', compact('cart'));
    }

    public function add($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $product = \App\Models\Product::findOrFail($id);
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);
        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
        return back()->with('success', 'Cập nhật thành công');
    }

    public function remove($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Xoá sản phẩm khỏi giỏ hàng');
    }
}




