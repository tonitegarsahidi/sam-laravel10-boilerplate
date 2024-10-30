<?php

namespace App\Http\Requests\Saas;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionMasterListRequest extends FormRequest
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
            "sort_field" => "nullable|string|in:alias,id,package_name,package_price,package_description,package_duration_days,is_visible,is_active,created_at",
            "keyword" => "nullable|string",
        ];
    }
}
