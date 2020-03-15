<?php

namespace App\Models;

use App\Exceptions\CouponCodeUnavailableException;
use Carbon\Carbon;
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
        } while (self::query()->where('code', $code)->exists());

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

    public function scopeWithType($query, $type)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($type) {
            //固定金额
            case 'fixed':
                $query->where('type', 'fixed');
                break;
            //percent
            case 'percent':
                $query->where('type', 'percent');
                break;
        }
        return $query;
    }

    public function checkAvailable($orderAmount = null)
    {
        if (!$this->enabled) {
            throw new CouponCodeUnavailableException('优惠券不能使用');
        }

        if ($this->total - $this->used <= 0) {
            throw new CouponCodeUnavailableException('该优惠券已被兑完');
        }
        if (!is_null($orderAmount) && $orderAmount < $this->min_amount) {
            throw new CouponCodeUnavailableException('订单金额不满足该优惠券最低金额');
        }
    }

    public function getAdjustedPrice($orderAmount)
    {
        // 固定金额
        if ($this->type === self::TYPE_FIXED) {
            // 为了保证系统健壮性，我们需要订单金额最少为 0.01 元
            return max(0.01, $orderAmount - $this->value);
        }

        return $orderAmount - number_format($orderAmount * (10 - $this->value) / 10, 2, '.', '');
    }

    public function changeUsed($increase = true)
    {
        // 传入 true 代表新增用量，否则是减少用量
        if ($increase) {
            // 与检查 SKU 库存类似，这里需要检查当前用量是否已经超过总量
            return $this->where('id', $this->id)->where('used', '<', $this->total)->increment('used');
        } else {
            return $this->decrement('used');
        }
    }
}
