<?php

namespace App\Http\Requests\Teacher\AccountSettings;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TeacherAccountSettingsPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required',
        ];
    }
}
