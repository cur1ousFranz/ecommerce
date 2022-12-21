<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest
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

    public function rules()
    {
        return [
            'verify_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'verify_code.required' => 'Verification code is required.',
        ];
    }
}
