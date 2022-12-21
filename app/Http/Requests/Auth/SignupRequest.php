<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6|max:16'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email.',
            'email.unique' => 'Email already exist.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password does not match.',
            'password.min' => 'Password must atleast 6 characters.',
            'password.max' => 'Password must not exceed 16 characters.',
        ];
    }
}
