<?php

namespace App\Http\Requests\User;

use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends ApiRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $this->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:10',
            'api_key' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d',
            'identity_type' => 'nullable|numeric|in:' . enumCaseValue(IdentityTypeEnum::class),
            'type' => ['nullable', 'numeric', 'in:' . enumCaseValue(UserTypeEnum::class)],
            'identity_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'country_id' => 'nullable|exists:countries,id',
        ];
    }
}
