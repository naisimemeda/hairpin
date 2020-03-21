<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'   => ['required', 'max:25'],
            'sort'   => ['integer'],
            'status' => ['integer', 'between:0,1'],
        ];
    }
}
