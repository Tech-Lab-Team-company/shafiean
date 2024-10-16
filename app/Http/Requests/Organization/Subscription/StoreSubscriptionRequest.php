<?php

namespace App\Http\Requests\Organization\Subscription;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionRequest extends ApiRequest
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
            "user_ids" => "required|array",
            "user_ids.*" => "required|exists:users,id",
            "course_id" => "required|exists:courses,id",
            "group_id" => "required|exists:groups,id",
        ];
    }
}
