<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $adminId = $this->route('id');

        return [
            'name' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:191',
                Rule::unique('admins')->ignore($adminId),
            ],
            'password' => 'nullable|string|min:8',
            'api_key' => 'nullable|string',
            'job_title' => 'nullable|string|max:191',
        ];
    }
}
