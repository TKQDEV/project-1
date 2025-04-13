<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Interfaces\ProductServiceInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductServiceInterface $productService, CategoryServiceInterface $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->searchPaginate($request->all());
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.products.create', compact('categories'));

        foreach ($request->file('images') as $image) {
            $path = $image->store('product_images', 'public');
            $product->images()->create(['path' => $path]);
        }
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $this->productService->createWithImages($data, $request->file('images'));
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = $this->productService->findById($id);
        $categories = $this->categoryService->getAll();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = $this->productService->findById($id);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');  // Lưu vào thư mục public
    
                // Lưu ảnh vào bảng product_images
                $product->images()->create([
                    'image_path' => $path,
                ]);
            }
        }
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index')->with('success', 'Xoá sản phẩm thành công!');
    }
}

