<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function store(Request $request, $productId)
    {
        // Validate request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Lấy thông tin sản phẩm
        $product = Product::findOrFail($productId);

        // Lưu file ảnh vào storage
        $path = $request->file('image')->store('product_images', 'public'); // lưu trong storage/app/public/product_images

        // Tạo bản ghi mới trong bảng product_images
        ProductImage::create([
            'image_path' => $path, // hoặc 'path' nếu bạn chọn dùng tên cột này
            'product_id' => $product->id,
        ]);

        // Trở lại trang danh sách sản phẩm
        return redirect()->route('products.show', $product->id)
            ->with('status', 'Ảnh đã được thêm thành công!');
    }


public function destroy($id)
{
    $image = ProductImage::findOrFail($id);
    
    // Xóa ảnh từ storage
    if (!empty($image->image_path) && Storage::exists($image->image_path)) {
        Storage::delete($image->image_path);
    }
    
    
    // Xóa bản ghi trong cơ sở dữ liệu
    $image->delete();

    return redirect()->back()->with('status', 'Ảnh đã được xóa!');
}


}
