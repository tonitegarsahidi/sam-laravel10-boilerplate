<?php

namespace App\Http\Requests\Saas;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUserListRequest extends FormRequest
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
            "per_page" => "nullable|integer",
            "page" => "nullable|integer",
            "sort_order" => "nullable|string|in:ASC,DESC,asc,desc",
            "sort_field" => "nullable|string|in:email,package_name,start_date,expired_date,is_suspended",
            "keyword" => "nullable|string",
            "userId" => "nullable|uuid",
        ];
    }
}
