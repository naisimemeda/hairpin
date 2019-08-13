<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'card_id', 'order_id'
    ];

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function card(){
        return $this->hasMany(Card::class, 'id', 'card_id');
    }
}
