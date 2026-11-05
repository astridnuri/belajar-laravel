<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'image', 'name', 'price', 'slug', 'brief_description', 'description'];

    //many to one
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //has many images
    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
