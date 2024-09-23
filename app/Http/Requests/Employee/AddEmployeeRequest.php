<?php

namespace App\Http\Requests\Employee;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddEmployeeRequest extends ApiRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:teachers,email',
            'phone' => 'required|string|max:191|unique:teachers,phone',
            'password' => 'required|string|max:191',
            'gender' => 'required|string|max:191',
            'age' => 'required|string|max:191',
            'is_employed' => 'required|max:191',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'certificate_images' => 'nullable|array',
            'certificate_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'marital_status' => 'required|integer',
            'identity_type' => 'required|integer',
            'identity_number' => 'required|string|max:191',
            'date_of_birth' => 'required',
            'curriculum_ids' => 'required_if:is_employed,1|array|exists:curriculums,id', // Moved here
        ];
    }
}
