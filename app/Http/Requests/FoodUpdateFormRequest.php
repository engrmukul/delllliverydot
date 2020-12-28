<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FoodUpdateFormRequest extends FormRequest
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
            'name' => 'required',
            'short_description' => 'required',
            'image' => 'required',
            'discount_price' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'unit' => 'required',
            'package_count' => 'required',
            'weight' => 'required',
            'featured' => 'required',
            'deliverable_food' => 'required',
            'restaurant_id' => 'required'
        ];
    }
}
