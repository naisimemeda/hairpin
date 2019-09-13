<?php

namespace App\Models;

use App\Exceptions\InternalException;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'table', 'description', 'image', 'on_sale', 'price', 'explain', 'category'
    ];
    protected $casts = [
        'on_sale' => 'boolean', // on_sale 是一个布尔类型的字段
    ];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function card(){
        return $this->hasMany(Card::class);
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }
}
