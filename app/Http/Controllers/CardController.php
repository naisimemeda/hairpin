<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Models\ProductSku;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request){
        $builder = Card::query();
        if($start_time = $request->input('start_time')){
            $end_time = $request->input('end_time');
            $builder->whereBetween('created_at', [$start_time, $end_time]);
        }
        //查询对应sku下的 卡密
        if($sku_id = $request->input('sku_id')){
            $builder->where('product_sku_id', $sku_id);
        }
        /*通过scope 筛选出相应数据
            1:未卖出的卡密
            2:已卖出的卡密
        */
        if($status = $request->input('type')){
            $builder->withStatus($status);
        }
        //查询卡号或者卡密
        if ($search = $request->input('search')){
            $like = '%'.$search.'%';
            $builder->where('card_no', 'like', $like);
        }

        $result =  $builder->paginate(16);
        return $this->setStatusCode(201)->success($result);
    }

    public function SkuCard(Request $request){
        $builder = ProductSku::query();
        if($product_id = $request->input('product_id')){
            $builder->where('product_id', $product_id);
        }

        if ($search = $request->input('search')){
            $like = '%'.$search.'%';
            $builder->where('title', 'like', $like);
        }

        //查询该sku 卡密总数
        $result = $builder->withCount(['card'])->get()->each(function ($item, $key){
            //查询这个sku 卖出总数
            $item['sell_out'] = Card::with(['skus'])->where('product_sku_id', $item['id'])->where('status', false)->count();
        });

        return $this->setStatusCode(201)->success($result);
    }

    public function store(CardRequest $request){
            $a = 'wqeqwe|dasdasd
  asdasd|dasddas
    asdasd|asdsad';
        $data = [];
        $shop_id = Shop::ShopInfo()->id;
        $cards  = explode(',', str_replace("\r\n",",",$a));
        foreach ($cards as $card){
            $no_key = explode('|', $card);
            $data[] = [
                //去除卡号.卡密中的空格
                'card_no' => str_replace(' ','',$no_key[0]),
                'card_key' => str_replace(' ','',$no_key[1]),
                'product_id' => $request->input('product_id'),
                'product_sku_id' => $request->input('product_sku_id'),
                'shop_id' => $shop_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ] ;
        }
        Card::insert($data);
        return $this->setStatusCode(201)->success('成功');
    }

    public function delete(CardRequest $request){
        $status = $request->input('type');
        $card = Card::query()->where('product_sku_id', $request->input('product_sku_id'));
        /*通过scope 筛选出相应数据
            1:未卖出的卡密
            2:已卖出的卡密
            3:全部
        */
        $card->withStatus($status)->delete();
        return $this->setStatusCode(201)->success('成功');
    }
}
