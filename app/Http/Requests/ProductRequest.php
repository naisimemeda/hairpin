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
            'explain' => ['required'],
            'price' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'integer'],
        ];
    }
}
