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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'currentpassword' => 'required|string',
            'newpassword' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            'confirmnewpassword' => 'required|string|same:newpassword',
        ];
    }

    public function messages()
    {
        return [
            'currentpassword.required' => 'The old password field is required.',
            'currentpassword.string' => 'The old password must be a string.',
            'newpassword.required' => 'The password field is required.',
            'newpassword.string' => 'The password must be a string.',
            'newpassword.min' => 'The password must be at least 8 characters long.',
            'newpassword.regex' => 'The password must contain a combination of letters and numbers.',
            'confirmnewpassword.required' => 'The confirmation password field is required.',
            'confirmnewpassword.string' => 'The confirmation password must be a string.',
            'confirmnewpassword.same' => 'The confirmation password must match the password field.',
        ];
    }
}
