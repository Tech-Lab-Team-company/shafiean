<?php

namespace App\Http\Requests\User;

use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
        ];
    }
}
