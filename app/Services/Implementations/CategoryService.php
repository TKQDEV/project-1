<?php

namespace App\Services\Implementations;

use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    public function getCategoryTree()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return $this->buildTree($categories);
    }

    private function buildTree($categories)
    {
        $tree = [];
        foreach ($categories as $category) {
            $children = $category->children ? $this->buildTree($category->children) : [];
            $tree[] = [
                'id' => $category->id,
                'name' => $category->name,
                'children' => $children,
            ];
        }
        return $tree;
    }

    public function getAll()
    {
        return Category::all(); // Fetch all categories
    }

    public function create(array $data)
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->parent_id = $data['parent_id'] ?? null; // Handle parent_id if provided
        $category->save(); // Save the category to the database

        return $category; // Return the created category
    }

    public function findById($id)
    {
        return Category::findOrFail($id); // Find category by ID or fail
    }

    public function update($id, array $data)
    {
        $category = Category::findOrFail($id); // Find category by ID or fail
        $category->name = $data['name']; // Update the name
        $category->parent_id = $data['parent_id'] ?? null; // Update parent_id if provided
        $category->save(); // Save the changes

        return $category; // Return the updated category
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id); // Find category by ID or fail
        $category->delete(); // Delete the category

        return $category; // Return the deleted category
        
    }

    public function getAllExcept($id)
    {
        return Category::where('id', '!=', $id)->get(); // Exclude the given ID
    }

    public function getTree()
    {
        return [
            'categories' => $this->getCategoryTree(), // Get the category tree
            'all_categories' => $this->getAll(), // Get all categories
            'all_categories_except' => $this->getAllExcept(null), // Get all categories except null (or any other ID)
            'category_count' => $this->getAll()->count(), // Count of all categories
        ];
    }

}    