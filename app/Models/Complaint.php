<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'order_id', 'qq' ,'phone', 'password', 'reason'
    ];

    public function order(){
        return $this->hasOne(Order::class, 'id');
    }
}
