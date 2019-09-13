<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => ['required', 'integer', 'min:1'],
            'phone'  => 'required',
        ];
    }
}
