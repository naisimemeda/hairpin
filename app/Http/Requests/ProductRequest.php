<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'table'  => ['required', 'max:25'],
            'description'  => ['required'],
            'image'  => ['required'],
            'skus'  => ['required', 'array'],
            'skus.*' => [ // 检查 skus 数组下每一个子数组的参数
                'required',
                function ($attribute, $value, $fail) {
                    if (empty($value['title']) || empty($value['description']) || empty($value['stock']) || empty($value['price'])) {
                        return $fail('sku内容不能为空');
                    }
                },
            ],
        ];
    }
}
