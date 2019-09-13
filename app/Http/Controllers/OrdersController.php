<?php

namespace App\Http\Controllers;

use App\Exceptions\CouponCodeUnavailableException;
use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\OrderRequest;
use App\Jobs\CloseOrder;
use App\Models\Complaint;
use App\Models\CouponCode;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $product    = Product::query()->find($request->input('product_id'));

        $card = $product->whereHas('card', function ($query) use($product){
            $query->where('product_id', $product->id)->where('status', true);
        })->get();
        if ($card->isEmpty()) {
            throw new InvalidRequestException('该商品库存不足');
        }
        //订单总金额
        $total_amount = $amount * $product->price;

        try{
            $order = \DB::transaction(function () use ($amount, $product, $request, $total_amount, $coupon) {
                $order = new Order([
                    'remark'       => $request->input('remark'),
                    'amount'       => $amount,
                    'total_amount' => $total_amount,
                    'phone'        => $request->input('phone'),
                    'email'        => $request->input('email'),
                ]);
                $order->product()->associate($product->id);
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
                $this->dispatch(new CloseOrder($order, config('app.order_ttl')));
                return $order;
            });
        }catch (\Exception $exception){
            throw new InternalException('系统内部错误');
        }
        return $this->setStatusCode(201)->success($order);
    }

    public function search(Request $request){
        $order = $this->SearchOrder($request);
        $card = $order->items()->with('card')->get();
        return $this->setStatusCode(201)->success([
            'order' => $order,
            'card' => $card
        ]);
    }

    public function Complaint(Request $request){
        $order = $this->SearchOrder($request);
        if(!$order->paid_at || !$order->refund_no){
            return $this->failed('不能申请退款', 401);
        }
        try{
            DB::transaction(function () use ($request, $order) {
                $shop = Shop::find($order->shop_id);
                $money = $order->total_amount;
                //先从冻结金额开始扣款, 不够就扣余额
                if($shop->frozen_money >= $money){
                    $shop->decrement('frozen_money', $money);
                }else{
                    $shop->decrement('money', $money);
                }
                $shop->increment('complaint_money', $money);
                $complaint = new Complaint([
                    'order_id' => $order->id,
                    'phone'    => $request->input('phone'),
                    'qq'       => $request->input('qq'),
                    'password' => $request->input('phone'),
                    'reason'   => $request->input('reason')
                ]);
                $complaint->save();
                //更新订单状态
                $order->update([
                    'refund_status' => Order::REFUND_STATUS_APPLIED,
                    //退款订单号
                    'refund_no'     => Order::getAvailableRefundNo(),
                ]);
            });
        }catch (\Exception $exception) {
            throw new InvalidRequestException('投诉订单失败');
        }
        return $this->setStatusCode(201)->success('成功');
    }

    public function SearchOrder($request){
        $no = $request->input('no');
        $order = Order::query()->where('no', $no)->firstOrFail();
        return $order;
    }
}
