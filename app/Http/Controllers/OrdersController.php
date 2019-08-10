<?php

namespace App\Http\Controllers;

use App\Exceptions\CouponCodeUnavailableException;
use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\OrderRequest;
use App\Models\CouponCode;
use App\Models\Order;
use App\Models\ProductSku;
use App\Models\Shop;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(OrderRequest $request){
        $amount = $request->input('amount');

        $coupon  = null;
        if ($code = $request->input('coupon_code')) {
            $coupon = CouponCode::where('code', $code)->where('shop_id', Shop::ShopInfo()->id)->first();
            if (!$coupon) {
                throw new InvalidRequestException('优惠券不存在');
            }
            $coupon->checkAvailable();
        }

        $sku    = ProductSku::find($request->input('sku_id'));
        //订单总金额
        $total_amount = $amount * $sku->price;
        //判断库存
        try{
            $order = \DB::transaction(function () use ($amount, $sku, $request, $total_amount, $coupon) {
                if ($sku->decreaseStock($amount) <= 0) {
                    throw new InvalidRequestException('该商品库存不足');
                }
                $order = new Order([
                    'remark'       => $request->input('remark'),
                    'amount'       => $amount,
                    'total_amount' => $total_amount,
                    'phone'        => $request->input('phone'),
                    'email'        => $request->input('email'),
                ]);
                $order->product()->associate($sku->product_id);
                $order->productSku()->associate($sku);
                $order->shop()->associate($request->input('shop_id'));
                $order->save();
                if ($coupon) {
                    // 把订单金额修改为优惠后的金额
                    $total_amount = $coupon->getAdjustedPrice($total_amount);
                    // 将订单与优惠券关联
                    $order->couponCode()->associate($coupon);
                    // 增加优惠券的用量，需判断返回值
                    if ($coupon->changeUsed() <= 0) {
                        throw new CouponCodeUnavailableException('该优惠券已被兑完');
                    }
                    // 更新订单总金额
                    $order->update(['total_amount' => $total_amount]);
                }

                return $order;
            });
        }catch (\Exception $exception){
            throw new InternalException('系统内部错误');
        }
        return $this->setStatusCode(201)->success($order);
    }
}
