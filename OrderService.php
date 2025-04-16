<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepositoryInterface;

class OrderService implements OrderServiceInterface
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function getOrdersByUserId($userId)
    {
        return $this->orderRepository->findByUserId($userId);
    }

    public function updateOrderStatus($id, array $data)
    {
        return $this->orderRepository->update($id, $data);
    }

    public function count(): int
    {
        return Order::count(); // Implement the count method
    }
}
