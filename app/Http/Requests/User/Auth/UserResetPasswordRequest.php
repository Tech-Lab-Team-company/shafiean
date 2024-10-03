<?php

namespace App\Http\Requests\User\Auth;

use App\Helpers\Response\ApiRequest;

class UserResetPasswordRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
