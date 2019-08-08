<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'table', 'description', 'image', 'on_sale', 'price', 'explain'
    ];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function Skus(){
        return $this->hasMany(ProductSku::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
