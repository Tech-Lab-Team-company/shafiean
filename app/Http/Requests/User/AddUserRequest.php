<?php

namespace App\Http\Requests\User;

use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:10',
            'api_key' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d',
            'identity_type' => 'nullable|numeric|in:' . enumCaseValue(IdentityTypeEnum::class),
            'type' => ['nullable', 'numeric', 'in:' . enumCaseValue(UserTypeEnum::class)],
            'identity_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => ['nullable', 'exists:cities,id'],
            'group_ids' => 'nullable|array',
            'group_ids.*' => ['nullable', Rule::exists('groups', 'id')->whereNull('deleted_at')],
            'relation_id' => 'requiredif:type,0|exists:relations,id',
            'parent_id' => ['requiredif:type,0', 'exists:users,id'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated();
        $data['name'] = strtolower($data['name']);
        return $data;
    }
}
