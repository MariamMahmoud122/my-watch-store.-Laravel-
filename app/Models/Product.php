<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public function details() {
    return $this->hasOne(ProductDetail::class);
}

public function category() {
    return $this->belongsTo(Category::class);
}
protected $fillable = ['name', 'description', 'price', 'image', 'category_id'];
}
