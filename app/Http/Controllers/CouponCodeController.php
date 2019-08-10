<?php

namespace App\Http\Controllers;

use App\Exceptions\InternalException;
use App\Http\Requests\CardRequest;
use App\Http\Requests\CouponCodeRequest;
use App\Models\CouponCode;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CouponCodeController extends Controller
{
    public function index(Request $request){
        $builder = CouponCode::query();
        if($start_time = $request->input('start_time')){
            $end_time = $request->input('end_time');
            $builder->whereBetween('created_at', [$start_time, $end_time]);
        }
        /* 优惠券类型
            1:未使用
            2:已使用
        */
        if($status = $request->input('type')){
            $builder->withType($status);
        }
        /*通过scope 筛选出相应数据
            1:未使用
            2:已使用
        */
        if($status = $request->input('status')){
            $builder->withStatus($status);
        }
        //查询优惠券
        if ($search = $request->input('search')){
            $like = '%'.$search.'%';
            $builder->where('code', 'like', $like);
        }

        $result =  $builder->paginate(16);
        return $this->setStatusCode(201)->success($result);
    }

    public function store(CouponCodeRequest $request){
        //生成数量
        $length = $request->input('length');
        $coupon = [];
        $shop_id = Shop::ShopInfo()->id;
        for ($i = 0; $length >= $i; $i++){
            $coupon[] = [
                'shop_id' => $shop_id,
                //生成不重复优惠码
                'code' => CouponCode::findAvailableCode(),
                //优惠券类型
                'type' => $request->input('type'),
                'value' => $request->input('value'),
                'total' => $request->input('total'),
                'min_amount' => $request->input('min_amount'),
                'enabled' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('coupon_codes')->insert($coupon);
        return $this->setStatusCode(201)->success('成功');
    }
}
