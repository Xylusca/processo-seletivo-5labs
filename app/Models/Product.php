<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}
