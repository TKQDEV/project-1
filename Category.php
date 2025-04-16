<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    // Quan hệ 1-n: một danh mục có thể có nhiều danh mục con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Quan hệ ngược lại: mỗi danh mục con có một danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Hiển thị danh mục cây (các danh mục con)
    public static function getCategoryTree()
    {
        return Category::whereNull('parent_id')->with('children')->get(); // Lấy tất cả danh mục cha và danh mục con của chúng
    }
}
