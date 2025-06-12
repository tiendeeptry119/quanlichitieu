<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'type', 'user_id']; // ✅ Thêm user_id và type

    // Mỗi danh mục thuộc về 1 người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Danh mục có nhiều giao dịch
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
