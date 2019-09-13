<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    const REFUND_STATUS_PENDING = 'pending';
    const REFUND_STATUS_APPLIED = 'applied';
    const REFUND_STATUS_SUCCESS = 'success';
    const REFUND_STATUS_FAILED  = 'failed';

    public static $refundStatusMap = [
        self::REFUND_STATUS_PENDING    => '未退款',
        self::REFUND_STATUS_APPLIED    => '已申请退款',
        self::REFUND_STATUS_SUCCESS    => '退款成功',
        self::REFUND_STATUS_FAILED     => '退款失败',
    ];


    protected $fillable = [
        'no', 'email', 'phone', 'total_amount', 'remark',
        'product_id', 'product_sku_id', 'amount',
        'paid_at' ,'payment_method', 'payment_no',
        'refund_status', 'refund_no', 'closed'
    ];
    protected $casts = [
        'closed'    => 'boolean',
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

    //生成订单号
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
    //生成退款订单号
    public static function getAvailableRefundNo()
    {
        do {
            // Uuid类可以用来生成大概率不重复的字符串
            $no = Uuid::uuid4()->getHex();
            // 为了避免重复我们在生成之后在数据库中查询看看是否已经存在相同的退款订单号
        } while (self::query()->where('refund_no', $no)->exists());

        return $no;
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function couponCode()
    {
        return $this->belongsTo(CouponCode::class);
    }

    public function items()
    {
        return $this->hasOne(OrderItem::class);
    }

}
