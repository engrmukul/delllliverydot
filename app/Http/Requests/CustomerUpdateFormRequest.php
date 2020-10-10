<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerUpdateFormRequest extends FormRequest
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
        if ($this->request->has('mobile')){
            $mobile = $this->mobile;
            $customerId = $this->id;
        }

        return [
            'name' =>  'required',
            'mobile' => [
                'required',
                Rule::unique('customers')->where(function ($query) use($mobile, $customerId) {
                    return $query->where('mobile', $mobile)->where('id', '<>', $customerId);
                }),
            ],
            'email' =>  'required',
            'password' =>  'required',
        ];
    }
}
