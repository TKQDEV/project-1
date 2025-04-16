<?php

namespace App\Repositories;

use App\Models\Category;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    public function create(array $data)
    {
        return Category::create($data);
    }

    public function findAll()
    {
        return Category::all();
    }

    public function findById($id)
    {
        return Category::find($id);
    }

    public function update($id, array $data)
    {
        $category = Category::find($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }
}
