<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponCodeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'  => ['required', Rule::in(['fixed', 'percent']),],
            'value' => [
                'required', 'integer', 'min:1', function ($attribute, $value, $fail) {
                    $type = $this->input('type');
                    if($type == 'percent'){
                        if ($value < 1 || $value > 10){
                            return $fail('非法折扣');
                        }
                    }
                },
            ],
            'total' => ['required', 'integer', 'min:1'],
            'min_amount' => ['required', 'integer', 'min:1'],
            'length' => ['required', 'integer', 'max:100'],
        ];
    }
}
