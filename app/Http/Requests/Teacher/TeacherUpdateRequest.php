<?php
namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class TeacherUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $teacherId = $this->route('id');

        return [
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                'unique:teachers,email,' . $teacherId,
            ],
            'password' => 'nullable|string|min:8|max:255',
            'gender' => 'nullable|string|max:20',
            'api_key' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:18',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'organization_id' => 'nullable|exists:organizations,id',
        ];
    }
}
