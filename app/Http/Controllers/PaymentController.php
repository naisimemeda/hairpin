<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidRequestException;
use App\Models\Card;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nice\XhySms\XhySms;

class PaymentController extends Controller
{
    /**
     * @param Order $order
     * @param Request $request
     * @return mixed
     * @throws InvalidRequestException
     */
    public function payByAlipay(Order $order, Request $request)
    {
        // 订单已支付或者已关闭
        if ($order->paid_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }
        // 调用支付宝的网页支付
        return app('alipay')->web([
            'out_trade_no' => $order->no, // 订单编号，需保证在商户端不重复
            'total_amount' => $order->total_amount, // 订单金额，单位元，支持小数点后两位
            'subject'      => '支付订单：'.$order->no, // 订单标题
        ]);
    }

    public function alipayReturn()
    {
        // 校验提交的参数是否合法
        $data = app('alipay')->verify();
        dd($data);
    }

    public function alipayNotify()
    {
        // 校验输入参数
        $data  = app('alipay')->verify();
        // 如果订单状态不是成功或者结束，则不走后续的逻辑
        // 所有交易状态：https://docs.open.alipay.com/59/103672
        if(!in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return app('alipay')->success();
        }
        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = Order::where('no', $data->out_trade_no)->first();
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }
        // 如果这笔订单的状态已经是已支付
        if ($order->paid_at) {
            // 返回数据给支付宝
            return app('alipay')->success();
        }

        $order->update([
            'paid_at'        => Carbon::now(), // 支付时间
            'payment_method' => 'alipay', // 支付方式
            'payment_no'     => $data->trade_no, // 支付宝订单号
        ]);

        $this->PayAfter($order);

        return app('alipay')->success();
    }


    //支付成功后调用
    public function PayAfter($order){
        //查出该商家sku下 可用的卡密
        $card = Card::where([
            ['product_sku_id', $order->product_sku_id],
            ['shop_id', $order->shop_id],
            ['status', true],
        ])->take($order->amount)->get();

        DB::transaction(function () use ($card, $order) {
            try {
                //修改查询出来的卡密的状态
                $card_id = collect($card)->pluck('id');
                Card::whereIn('id', $card_id)->update([
                    'status' => false,
                    'sell_time' => Carbon::now()
                ]);
                //插入订单详情
                $items = [];
                foreach ($card as $item){
                    $items[] = [
                        'order_id' => $order->id,
                        'card_id' => $item->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                OrderItem::insert($items);
                $amount = $order->amount;  //订单数量
                //添加暂存金额
                $shop = Shop::find($order->shop_id);
                $shop->increment('frozen_money', $order->total_amount);
                //增加商品销量
                $product = Product::find($order->product_id);
                $product->increment('sold_count', $amount);
                //发送订单号
                app('XhySms')->send($order->phone,  [
                    'template' => 'SMS_163853034',
                    'data' => [
                        'code' => $order->no
                    ]
                ], 'aliyun');
            } catch (\Exception $exception) {
                throw new InvalidRequestException('短信发送失败');
            }
        });
    }
}
