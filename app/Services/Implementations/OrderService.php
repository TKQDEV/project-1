<?php

namespace App\Services\Implementations;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Interfaces\OrderServiceInterface;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    public function createFromCart(array $cart, $userId)
    {
        return DB::transaction(function () use ($cart, $userId) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return $order;
        });
    }

    public function getOrdersByUser($userId)
    {
        return Order::where('user_id', $userId)->with('items.product')->get();
    }

    public function count(): int
    {
        return Order::count();
    }

    public function getAll()
    {
        return Order::with('user', 'items.product')->get();
    }

    public function updateStatus($id, $status)
    {
        $order = Order::findOrFail($id);
        $order->status = $status;
        $order->save();
        return $order;
    }

    public function createOrder($userId, $cartItems)
    {
        $order = Order::create([
            'user_id' => $userId,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        return $order;
    }

    public function getUserOrders($userId)
    {
        return Order::with('items.product')->where('user_id', $userId)->latest()->get();
    }


}
