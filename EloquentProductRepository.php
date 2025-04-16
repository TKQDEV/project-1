<?php

namespace App\Repositories;

use App\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function create(array $data)
    {
        return Product::create($data);
    }

    public function findAll()
    {
        return Product::all();
    }

    public function findById($id)
    {
        return Product::find($id);
    }

    public function update($id, array $data)
    {
        $product = Product::find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }
}
