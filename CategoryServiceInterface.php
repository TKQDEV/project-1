<?php

namespace App\Services;

interface CategoryServiceInterface
{
    public function create(array $data);
    public function getAllCategories();
    public function getCategoryById($id);
    public function updateCategory($id, array $data);
    public function deleteCategory($id);
}
