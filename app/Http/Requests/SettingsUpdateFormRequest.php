<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingsUpdateFormRequest extends FormRequest
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
            'SERVER_API_KEY' => 'required',
            'PUSHER_APP_ID' => 'required',
            'PUSHER_APP_KEY' => 'required',
            'PUSHER_APP_SECRET' => 'required',
            'PUSHER_APP_CLUSTER' => 'required',
            'TWILIO_SID' => 'required',
            'TWILIO_AUTH_TOKEN' => 'required',
            'TWILIO_VERIFY_SID' => 'required'
        ];
    }
}
