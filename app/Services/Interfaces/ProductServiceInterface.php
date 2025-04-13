<?php

namespace App\Services\Interfaces;

interface ProductServiceInterface
{
    public function getAll();

    public function searchPaginate(array $filters);

    public function findById($id);

    public function createWithImages(array $data, $images = []);

    public function updateWithImages($id, array $data, $images = []);

    public function delete($id);

    public function count(): int;

    public function create($data);

    public function update($id, $request);
}

