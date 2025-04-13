<?php

namespace App\Services\Interfaces;

interface CategoryServiceInterface
{
    public function getCategoryTree();
    public function getAll();
    public function create(array $data);
    public function findById($id);
    public function update($id, array $data);
    public function delete($id);
    public function getAllExcept($id); // Add this method
    public function getTree();
}