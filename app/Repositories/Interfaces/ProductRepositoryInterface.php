<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function all();

    public function paginate($limit = 10);

    public function searchPaginate(array $filters, $limit = 10);

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function attachImages($productId, array $images);

    public function deleteImages($productId);
}

