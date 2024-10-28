<?php

namespace App\Http\Requests\User\Profile;


use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
