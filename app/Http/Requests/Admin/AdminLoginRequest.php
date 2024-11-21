<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends ApiRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}
