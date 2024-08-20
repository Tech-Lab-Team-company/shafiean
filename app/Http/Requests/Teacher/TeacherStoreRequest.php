<?php
namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:8|max:255',
            'gender' => 'nullable|string|max:20',
            'api_key' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:18',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }
}
