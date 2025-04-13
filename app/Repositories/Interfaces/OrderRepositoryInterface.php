<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $attributes);
    public function updateStatus($id, $status);
    public function getOrdersByUser($userId);
}
