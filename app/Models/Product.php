<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\User;

class Product extends Model
{
    protected $fillable =
    [
        'title',
        'price',
        'description',
        'vendor_id',
        'category',
        'brand',
        'discount_percentage',
        'rating',
        'stock',
        'thumbnail',
        'image1',
        'image2',
        'image3',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }


    /**
     * Define a relação com as imagens do produto.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
