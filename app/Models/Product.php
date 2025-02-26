<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products');
    }
    public function products()
    {
        return $this->hasMany(CategoryProduct::class)->with('product');
    }
}
