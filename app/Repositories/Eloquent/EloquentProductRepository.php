<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class EloquentProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return Product::with('category')->get();
    }

    public function paginate($limit = 10)
    {
        return Product::with('category')->paginate($limit);
    }

    public function searchPaginate(array $filters, $limit = 10)
    {
        return Product::with('category')
            ->when($filters['keyword'] ?? null, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
            })
            ->when($filters['category_id'] ?? null, function ($query, $category_id) {
                $query->where('category_id', $category_id);
            })
            ->paginate($limit);
    }

    public function find($id)
    {
        return Product::with('images')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = $this->find($id);
        $product->update($data);
        return $product;
    }

    public function delete($id)
    {
        $product = $this->find($id);
        $this->deleteImages($id);
        return $product->delete();
    }

    public function attachImages($productId, array $images)
    {
        $product = $this->find($productId);
        foreach ($images as $image) {
            $path = $image->store('product_images', 'public');
            $product->images()->create(['path' => $path]);
        }
    }

    public function count()
{
    return $this->model->count();
}


    public function deleteImages($productId)
    {
        $product = $this->find($productId);
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
            $img->delete();
        }
    }
}
