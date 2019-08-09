<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CouponCode extends Model
{
    const TYPE_FIXED = 'fixed';
    const TYPE_PERCENT = 'percent';

    public static $typeMap = [
        self::TYPE_FIXED   => '固定金额',
        self::TYPE_PERCENT => '比例',
    ];

    protected $fillable = [
      'code', 'shop_id', 'type', 'value', 'min_amount', 'enabled', 'total' ,'used'
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];

    protected $appends = ['description'];

    public function getDescriptionAttribute()
    {
        $str = '';

        if ($this->min_amount > 0) {
            $str = '满'.$this->min_amount;
        }
        if ($this->type === self::TYPE_PERCENT) {
            return $str.'优惠'.$this->value.'%';
        }

        return $str.'减'.$this->value;
    }


    public static function findAvailableCode($length = 16)
    {
        do {
            // 生成一个指定长度的随机字符串，并转成大写
            $code = strtoupper(Str::random($length));
            // 如果生成的码已存在就继续循环
        } while (self::query()->where('code', $code)->where('shop_id', 1)->exists());

        return $code;
    }

    public function scopeWithStatus($query, $type)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($type) {
            //未使用优惠券
            case '1':
                $query->where('enabled', true);
                break;
            //已使用优惠券
            case '2':
                $query->where('enabled', false);
                break;
        }
        return $query;
    }

    public function scopeWithTyoe($query, $type)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($type) {
            //固定金额
            case 'fixed':
                $query->where('type', $type);
                break;
            //percent
            case '比例':
                $query->where('type', $type);
                break;
        }
        return $query;
    }
}
