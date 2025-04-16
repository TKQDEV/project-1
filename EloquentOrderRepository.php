<?php

namespace App\Repositories;

use App\Models\Order;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function create(array $data)
    {
        return Order::create($data);
    }

    public function findById($id)
    {
        return Order::find($id);
    }

    public function findByUserId($userId)
    {
        return Order::where('user_id', $userId)->get();
    }

    public function update($id, array $data)
    {
        $order = Order::find($id);
        $order->update($data);
        return $order;
    }
}
