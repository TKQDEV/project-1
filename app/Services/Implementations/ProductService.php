<?php

namespace App\Services\Implementations;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\ProductServiceInterface;
use App\Models\Product;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->all();
    }

    public function searchPaginate(array $filters)
    {
        return $this->productRepository->searchPaginate($filters);
    }

    public function findById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createWithImages(array $data, $images = [])
    {
        $product = $this->productRepository->create($data);
        if ($images) {
            $this->productRepository->attachImages($product->id, $images);
        }
        return $product;
    }

    public function count(): int
    {
        return Product::count();
    }

    public function all()
{
    return $this->productRepository->all();
}


    public function updateWithImages($id, array $data, $images = [])
    {
        $product = $this->productRepository->update($id, $data);
        if ($images) {
            $this->productRepository->deleteImages($id);
            $this->productRepository->attachImages($id, $images);

            if ($images) {
                foreach ($images as $image) {
                    $path = $image->store('products', 'public');
                    $product->images()->create(['path' => $path]);
                }
            }
            
        }
        return $product;
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
        
    }

    public function create($data)
    {
        return $this->productRepository->create($data);

    }

    public function update($id, $request)
    {
        return $this->productRepository->update($id, $request);
    }

    
}
