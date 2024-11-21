<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ];
    }
}

