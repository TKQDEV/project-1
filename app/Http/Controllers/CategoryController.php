<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getCategoryTree();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll(); // để chọn danh mục cha
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->categoryService->create($request->only(['name', 'parent_id']));

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function edit($id)
    {
        $category = $this->categoryService->findById($id);
        $categories = $this->categoryService->getAllExcept($id); // loại trừ chính nó
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate
    
    ([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->categoryService->update($id, $request->only(['name', 'parent_id']));

        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
    }
    public function destroy($id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
    }
}