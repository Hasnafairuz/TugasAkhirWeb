<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'store_id',
    'name',
    'category',
    'colors',
    'size',
    'price',
    'discount_price',
    'stock',
    'image',
    'description',
];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
        }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}