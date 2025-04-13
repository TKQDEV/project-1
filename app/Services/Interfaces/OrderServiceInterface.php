<?php

namespace App\Services\Interfaces;

interface OrderServiceInterface
{
    public function createFromCart(array $cart, $userId);

    public function getOrdersByUser($userId);

    public function getAll();

    public function updateStatus($id, $status);

    public function count(): int;

    public function createOrder($userId, $cartItems);

    public function getUserOrders($userId);

}