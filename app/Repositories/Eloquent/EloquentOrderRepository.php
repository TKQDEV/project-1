<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class EloquentOrderRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return Order::with('items.product')->paginate(10);
    }

    public function find($id)
    {
        return Order::with('items.product')->findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Order::create($attributes);
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return $order;
    }

    public function getOrdersByUser($userId)
    {
        return Order::with('items.product')->where('user_id', $userId)->get();
    }

    public function count()
    {
        return $this->model->count();
    }
    
    
}
