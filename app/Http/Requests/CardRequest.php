<?php

namespace App\Http\Requests;

use App\Models\Card;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'card_no'  => [
                            'required', function ($attribute, $value, $fail) {
                                if (Card::where('shop_id', Shop::ShopInfo()->id)->where('card_no', $value)->first()) {
                                    return $fail('重复卡密');
                                }
                            },
                        ],
                        'card_key'  => ['required'],
                        'product_id' => [
                            'required', function ($attribute, $value, $fail) {
                                if (!$product = Product::find($value)) {
                                    return $fail('该商品不存在');
                                }
                            },
                            Rule::exists('products', 'id')->where('shop_id', Shop::ShopInfo()->id),
                        ],
                        'product_sku_id' => [
                            'required', function ($attribute, $value, $fail) {
                                if (!$sku = ProductSku::find($value)) {
                                    return $fail('该商品不存在');
                                }
                                if (!$sku->product->on_sale) {
                                    return $fail('该商品未上架');
                                }
                            },
                        ],
                    ];
                }
            case 'DELETE':
                {
                    return [
                        'type' => 'required|between:1,3',
                        'product_sku_id' => [
                            'required', function ($attribute, $value, $fail) {
                                if (!$sku = ProductSku::find($value)) {
                                    return $fail('该商品不存在');
                                }
                                if (!$sku->product->on_sale) {
                                    return $fail('该商品未上架');
                                }
                            },
                        ],
                    ];
                }
        }


    }

    public function attributes()
    {
        return [
            'product_id' => '当前商家与商品的商家不同',
        ];
    }
}
