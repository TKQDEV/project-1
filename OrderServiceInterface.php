<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function createOrder(array $data);
    public function getOrdersByUserId($userId);
    public function updateOrderStatus($id, array $data);
    public function count(): int;
}
