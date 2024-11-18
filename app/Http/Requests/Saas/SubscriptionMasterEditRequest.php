<?php

namespace App\Http\Requests\Saas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionMasterEditRequest extends FormRequest
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
            'alias' => [
                'required',
                'string',
                'max:255',
                // Ensure 'alias' is unique, but ignore the current record
                Rule::unique('subscription_master', 'alias')->ignore($this->route('id')),
            ],
            'package_name' => 'required|string|max:255',
            'package_description' => 'required|string|max:1000',
            'package_price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'is_visible' => 'boolean',
            'package_duration_days' => 'required|integer|min:1',
            'created_by' => 'nullable|string|max:255',
            'updated_by' => 'nullable|string|max:255',
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
            'alias.required' => 'The alias field is required.',
            'alias.string' => 'The alias must be a valid string.',
            'alias.max' => 'The alias must not exceed 255 characters.',
            'alias.unique' => 'The alias has already been taken.',

            'package_name.required' => 'The package name is required.',
            'package_name.string' => 'The package name must be a valid string.',
            'package_name.max' => 'The package name must not exceed 255 characters.',

            'package_description.required' => 'The package description is required.',
            'package_description.string' => 'The package description must be a valid string.',
            'package_description.max' => 'The package description must not exceed 1000 characters.',

            'package_price.required' => 'The package price is required.',
            'package_price.numeric' => 'The package price must be a valid number.',
            'package_price.min' => 'The package price must be at least 0.',

            'is_active.boolean' => 'The is active field must be true or false.',
            'is_visible.boolean' => 'The is visible field must be true or false.',

            'package_duration_days.required' => 'The package duration in days is required.',
            'package_duration_days.integer' => 'The package duration must be a valid integer.',
            'package_duration_days.min' => 'The package duration must be at least 1 day.',

            'created_by.string' => 'The created by field must be a valid string.',
            'created_by.max' => 'The created by field must not exceed 255 characters.',

            'updated_by.string' => 'The updated by field must be a valid string.',
            'updated_by.max' => 'The updated by field must not exceed 255 characters.',
        ];
    }
}
