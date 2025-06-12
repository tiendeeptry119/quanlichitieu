<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'amount', 'type', 'category_id', 'date','user_id'
    ];

    // Mối quan hệ: mỗi sản phẩm thuộc một danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}