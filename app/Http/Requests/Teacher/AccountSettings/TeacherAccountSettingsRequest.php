<?php

namespace App\Http\Requests\Teacher\AccountSettings;


use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TeacherAccountSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers,email,' . Auth::user()->id,
            'phone' => 'required|string|max:20|unique:teachers,phone,' . Auth::user()->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ];
    }
}
