<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'nullable|regex:/^[0-9\+]+$/',
            'is_active' => 'required|boolean',
            'roles' => 'required|array|min:1',
            'password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d).+$/',
            'confirmpassword' => 'required|string|same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The full name field is required.',
            'name.string' => 'The full name must be a string.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone_number.regex' => 'The phone number must contain only numeric characters and/or the \'+\' sign.',
            'is_active.required' => 'Please select whether the user is active or not.',
            'is_active.boolean' => 'The active field must be true or false.',
            'roles.required' => 'Please select at least one role for the user.',
            'roles.array' => 'Invalid roles format.',
            'roles.min' => 'Please select at least one role for the user.',
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
