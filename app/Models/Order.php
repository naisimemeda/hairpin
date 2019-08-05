<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'no', 'email', 'phone', 'total_amount', 'remark',
        'product_id', 'product_sku_id', 'amount',
        'paid_at' ,'payment_method', 'payment_no'
    ];

    protected $dates = [
        'paid_at',
    ];

    protected static function boot()
    {
        parent::boot();
        // 监听模型创建事件，在写入数据库之前触发
        static::creating(function ($model) {
            // 如果模型的 no 字段为空
            if (!$model->no) {
                // 调用 findAvailableNo 生成订单流水号
                $model->no = static::findAvailableNo();
                // 如果生成失败，则终止创建订单
                if (!$model->no) {
                    return false;
                }
            }
        });
    }

    public static function findAvailableNo(){
        $prefix = date('YmdHis');
        for ($i = 0; $i < 10; $i++) {
            // 随机生成 6 位的数字
            $no = $prefix.str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            // 判断是否已经存在
            if (!static::query()->where('no', $no)->exists()){
                return $no;
            }
        }
        \Log::warning('find order no failed');
        return false;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function productSku(){
        return $this->belongsTo(ProductSku::class);
    }
}
