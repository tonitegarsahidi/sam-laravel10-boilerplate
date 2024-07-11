<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old' => 'required|string',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            'confirmpassword' => 'required|string|same:password',
        ];
    }

    public function messages()
    {
        return [
            'oldpassword.required' => 'The old password field is required.',
            'oldpassword.string' => 'The old password must be a string.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain a combination of letters and numbers.',
            'confirmpassword.required' => 'The confirmation password field is required.',
            'confirmpassword.string' => 'The confirmation password must be a string.',
            'confirmpassword.same' => 'The confirmation password must match the password field.',
        ];
    }
}
