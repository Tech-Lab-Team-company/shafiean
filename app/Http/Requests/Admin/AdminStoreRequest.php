<?php

namespace App\Http\Requests\Admin;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminStoreRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:191',
                'unique:admins',
            ],
            'password' => 'nullable|string|min:8',
            'api_key' => 'nullable|string',
            'job_title' => 'nullable|string|max:191',
        ];
    }
}
