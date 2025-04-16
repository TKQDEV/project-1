<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function create(array $data);
    public function findById($id);
    public function findByUserId($userId);
    public function update($id, array $data);
}
