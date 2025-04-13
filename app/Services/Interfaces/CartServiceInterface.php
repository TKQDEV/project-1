<?php

namespace App\Services\Interfaces;

interface CartServiceInterface
{
    public function getCart();
    public function addToCart($productId, $quantity);
    public function updateQuantity($productId, $quantity);
    public function removeFromCart($productId);
    public function clearCart();
}
