<?php

namespace App\Http\Requests\Employee;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditEmployeeRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:teachers,id',
            'name' => 'nullable|string|max:191',
            'email' => 'nullable|email|max:191|unique:teachers,email,' . $this->id,
            'phone' => 'nullable|string|max:191|unique:teachers,phone,' . $this->id,
            'gender' => 'nullable|string|max:191',
            'age' => 'nullable|string|max:191',
            'is_employed' => 'nullable|max:191',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'curriculum_ids' => 'nullable|array|exists:curriculums,id',
            'job_type_id' => 'required|exists:job_types,id',
        ];
    }
}
