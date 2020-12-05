<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryStoreFormRequest extends FormRequest
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
            'customer_id' =>  'required',
            'from_name' =>  'required',
            'from_phone' =>  'required',
            'from_email' =>  'required',
            'from_address' =>  'required',
            'to_name' =>  'required',
            'to_phone' =>  'required',
            'to_email' =>  'required',
            'to_address' =>  'required',
            'to_area' =>  'required',
            'to_district' =>  'required',
            'to_post_code' =>  'required',
            'item_name' =>  'required',
            'item_type' =>  'required',
            'width' =>  'required',
            'height' =>  'required',
            'length' =>  'required',
            'weight' =>  'required',
            'instructions' =>  'required',
            'pickup_time' =>  'required',
        ];
    }
}
