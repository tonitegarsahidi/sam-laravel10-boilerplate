<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone_number' => 'nullable|regex:/^[0-9\+]+$/',
            'is_active' => 'nullable|boolean',
            'roles' => 'nullable|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.nullable' => 'The full name field is nullable.',
            'name.string' => 'The full name must be a string.',
            'email.nullable' => 'The email field is nullable.',
            'email.email' => 'Please enter a valid email address.',
            'phone_number.regex' => 'The phone number must contain only numeric characters and/or the \'+\' sign.',
            'is_active.nullable' => 'Please select whether the user is active or not.',
            'is_active.boolean' => 'The active field must be true or false.',
            'roles.nullable' => 'Please select at least one role for the user.',
            'roles.array' => 'Invalid roles format.',
            'roles.min' => 'Please select at least one role for the user.',
        ];
    }
}
