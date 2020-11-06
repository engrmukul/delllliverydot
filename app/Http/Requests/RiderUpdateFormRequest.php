<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RiderUpdateFormRequest extends FormRequest
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
            $riderId = $this->rider_id;
        }

        return [
            'name' =>  'required',
            'phone_number' => [
                'required',
                Rule::unique('riders')->where(function ($query) use($phone_number, $riderId) {
                    return $query->where('phone_number', $phone_number)->where('id', '<>', $riderId);
                }),
            ],
            'email' =>  'required',
            'password' =>  'required',
            'address' =>  'required',
        ];
    }
}
