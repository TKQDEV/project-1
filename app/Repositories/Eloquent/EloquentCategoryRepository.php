<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::all();
    }

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Category::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $category = Category::findOrFail($id);
        $category->update($attributes);
        return $category;
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }
}
