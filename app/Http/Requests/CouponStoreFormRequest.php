<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponStoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code' => 'required',
            'total_code' => 'required',
            'total_used_code' => 'required',
            'discount_type' => 'required',
            'discount' => 'required',
            'description' => 'required',
            'food_id' => 'required',
            'restaurant_id' => 'required',
            'category_id' => 'required',
            'expire_at' => 'required',
            //'enabled' => 'required'
        ];
    }
}
