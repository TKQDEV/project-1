<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Lấy danh mục để gắn sản phẩm vào
        $smartphoneCategory = \App\Models\Category::where('name', 'Smartphone')->first();
        $laptopCategory = \App\Models\Category::where('name', 'Laptop')->first();

        // Thêm sản phẩm cho danh mục "Smartphone"
        Product::create([
            'name' => 'iPhone 13',
            'price' => 20000000,
            'description' => 'Điện thoại iPhone 13 với màn hình OLED và chip A15 Bionic.',
            'category_id' => $smartphoneCategory->id,
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S21',
            'price' => 15000000,
            'description' => 'Điện thoại Samsung Galaxy S21 với camera 64MP và màn hình Dynamic AMOLED.',
            'category_id' => $smartphoneCategory->id,
        ]);

        // Thêm sản phẩm cho danh mục "Laptop"
        Product::create([
            'name' => 'MacBook Pro 16 inch',
            'price' => 50000000,
            'description' => 'Laptop MacBook Pro với chip M1 Pro và màn hình Retina 16 inch.',
            'category_id' => $laptopCategory->id,
        ]);

        Product::create([
            'name' => 'Dell XPS 13',
            'price' => 30000000,
            'description' => 'Laptop Dell XPS 13 với màn hình 13 inch và chip Intel Core i7.',
            'category_id' => $laptopCategory->id,
        ]);
    }
}

