<?php

namespace App\Services\Implementations;

use App\Models\Product;
use App\Services\Interfaces\CartServiceInterface;

class CartService implements CartServiceInterface
{
    public function getCart()
    {
        return session()->get('cart', []);
    }

    public function addToCart($productId, $quantity)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);
    }

    public function updateQuantity($productId, $quantity)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }

    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    public function clearCart()
    {
        session()->forget('cart');
    }
}
