<?php

namespace App\Http\Requests;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'table'  => ['required', 'max:25'],
            'description'  => ['required'],
            'image'  => ['required'],
            'explain' => ['required'],
            'price' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'integer', Rule::exists('product_categories', 'id')->where('shop_id', Shop::ShopInfo()->id)],
        ];
    }
}
