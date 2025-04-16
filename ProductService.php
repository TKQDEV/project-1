<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;
use App\Models\Product;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function getAllProducts()
    {
        return $this->productRepository->findAll();
    }

    public function getProductById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->delete($id);
    }

    public function count(): int
    {
        return Product::count(); 
    }
}
