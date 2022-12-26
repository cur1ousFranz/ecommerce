<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordResetRequest extends FormRequest
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
            'password' => 'required|confirmed|min:6|max:16',
            'token' => 'required|exists:users,forgot_password_token',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password does not match.',
            'password.min' => 'Password must atleast 6 characters.',
            'password.max' => 'Password must not exceed 16 characters.',
            'token.exists' => 'Session Expired. Try again.',
            'token.required' => 'Session Expired. Try again.',
        ];
    }
}
