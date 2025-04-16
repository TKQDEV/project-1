<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function create(array $data);
    public function getAllProducts();
    public function getProductById($id);
    public function updateProduct($id, array $data);
    public function deleteProduct($id);
    public function count(): int; // Add count method declaration

}
