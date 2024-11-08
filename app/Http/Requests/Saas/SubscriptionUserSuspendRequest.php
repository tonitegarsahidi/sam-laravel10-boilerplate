<?php

namespace App\Http\Requests\Saas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionUserSuspendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set to true if you don't have specific authorization logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'id.required' => 'The id is required.',
            'id.numeric' => 'The id must be a valid number.',
            'id.min' => 'The id must be at least 0.',
        ];
    }
}
