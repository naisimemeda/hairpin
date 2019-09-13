<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name'
    ];

    public function product(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
