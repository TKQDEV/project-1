<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Thêm danh mục gốc
        Category::create([
            'name' => 'Điện Thoại',
            'parent_id' => null,
        ]);

        Category::create([
            'name' => 'Máy Tính',
            'parent_id' => null,
        ]);

        // Thêm danh mục con cho "Điện Thoại"
        Category::create([
            'name' => 'Smartphone',
            'parent_id' => 1, // ID của danh mục "Điện Thoại"
        ]);

        Category::create([
            'name' => 'Phụ Kiện',
            'parent_id' => 1, // ID của danh mục "Điện Thoại"
        ]);

        // Thêm danh mục con cho "Máy Tính"
        Category::create([
            'name' => 'Laptop',
            'parent_id' => 2, // ID của danh mục "Máy Tính"
        ]);

        Category::create([
            'name' => 'PC',
            'parent_id' => 2, // ID của danh mục "Máy Tính"
        ]);
    }
}
