<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Shop extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'phone', 'email', 'password', 'status', 'avatar', 'money', 'frozen_money'
    ];

    protected $hidden = [
        'password'
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return ['role' => 'shop'];
    }

    public function order(){
        return $this->hasMany(Order::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public static function ShopInfo(){
        return Auth::guard('shop')->user();
    }

    public function card(){
        return $this->hasMany(Card::class);
    }
}
