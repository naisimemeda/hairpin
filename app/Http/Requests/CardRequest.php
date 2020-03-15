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
                        'product_id' => [
                            'required', function ($attribute, $value, $fail) {
                                if (!$product = Product::find($value)) {
                                    return $fail('该商品不存在');
                                }
                            },
                            Rule::exists('products', 'id')->where('shop_id', Shop::ShopInfo()->id),
                        ],
                        'cards' => 'required'
                    ];
                }
            case 'DELETE':
                {
                    return [
                        'type' => 'required|between:1,3',
                        'product_id' => [
                            'required', function ($attribute, $value, $fail) {
                                if (!$sku = Product::find($value)) {
                                    return $fail('该商品不存在');
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
