<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\ProductServiceInterface;

class ProductController extends Controller
{
    public function __construct(protected ProductServiceInterface $productService) {}

    public function index()
    {
        $products = $this->productService->getAllPaginated();
        return view('user.products.index', compact('products'));
    }
}
