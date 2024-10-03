<?php

namespace App\Http\Requests\User\Auth;

use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends ApiRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|string|max:10',
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
