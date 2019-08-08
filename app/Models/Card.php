<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'card_no', 'card_key', 'shop_id', 'product_id', 'product_sku_id', 'status'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function skus(){
        return $this->belongsTo(ProductSku::class);
    }

    public function scopeWithStatus($query, $type)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($type) {
            //删除未卖出的卡密
            case '1':
                $query->where('status', true);
                break;
            //删除已卖出的卡密
            case '2':
                $query->where('status', false);
                break;
        }
        return $query;
    }
}
