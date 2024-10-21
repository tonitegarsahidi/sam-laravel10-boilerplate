<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        // Authorize the user
        return true;
    }

    public function rules()
    {
        return [
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5243',  // Optional, max size 5MB (you can change this)
            'name'            => 'required|string|max:255',
            'phone_number'    => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:255',
            'city'            => 'nullable|string|max:100',
            'country'         => 'nullable|string|max:100',
            'gender'          => 'nullable|in:male,female',
            'date_of_birth'   => 'nullable|date|before:today', // Must be a valid date before today
        ];
    }

    public function messages()
    {
        return [
            // Custom error messages
            'profile_picture.image'        => 'The profile picture must be an image file (jpeg, png, jpg, gif).',
            'profile_picture.mimes'        => 'Allowed image formats are jpeg, png, jpg, and gif.',
            'profile_picture.max'          => 'The profile picture size must not exceed 5MB.',
            'name.required'                => 'Please enter your full name.',
            'name.max'                     => 'The name may not be greater than 255 characters.',
            'phone_number.max'             => 'The phone number may not be greater than 20 characters.',
            'address.max'                  => 'The address may not be greater than 255 characters.',
            'city.max'                     => 'The city name may not be greater than 100 characters.',
            'country.max'                  => 'The country name may not be greater than 100 characters.',
            'gender.in'                    => 'Please select a valid gender (male or female).',
            'date_of_birth.date'           => 'Please enter a valid date of birth.',
            'date_of_birth.before'         => 'The date of birth must be a date before today.',
        ];
    }
}
