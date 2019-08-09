<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\ProductSku;
use App\Models\Shop;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function store(OrderRequest $request){
        $amount = $request->input('amount');
        $sku    = ProductSku::find($request->input('sku_id'));
        //订单总金额
        $total_amount = $amount * $sku->price;
        //判断库存
        try{
            $order = \DB::transaction(function () use ($amount, $sku, $request, $total_amount) {
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
                return $order   ;
            });
        }catch (\Exception $exception){
            throw new InternalException('系统内部错误');
        }
        return $this->setStatusCode(201)->success($order);
    }
}
