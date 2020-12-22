<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantUpdateFormRequest extends FormRequest
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
       if ($this->request->has('phone_number')){
            $phone_number = $this->phone_number;
            $restaurantId = $this->restaurant_id;
        }

        return [
            'name' =>  'required',
            'phone_number' => [
                'required',
                Rule::unique('restaurants')->where(function ($query) use($phone_number, $restaurantId) {
                    return $query->where('phone_number', $phone_number)->where('id', '<>', $restaurantId);
                }),
            ],
            'email' =>  'required',
            'address' =>  'required',
        ];
    }
}
