<?php

namespace App\Http\Requests\Employee;

use App\Enum\GenderEnum;
use App\Enum\MaritalStatusEnum;
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
            'gender' => 'nullable|string|in:' . enumCaseValue(GenderEnum::class),
            'age' => 'nullable|integer|min:14|max:100',
            'is_employed' => 'nullable|max:191',
            // 'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'certificate_images' => 'nullable|array',
            'certificate_images.*' => 'nullable|image|mimes:jpg,jpeg,png',
            'marital_status' => 'nullable|integer|in:' . enumCaseValue(MaritalStatusEnum::class),
            'identity_type' => 'nullable|integer',
            'identity_number' => 'nullable|string|max:191',
            'date_of_birth' => 'nullable',
            'curriculum_ids' => 'nullable|array|exists:curriculums,id', // Moved here
            'job_type_id' => 'nullable|exists:job_types,id',
            'role_id' => 'nullable|exists:roles,id',
            "nationality_id" => "nullable|exists:countries,id",
            'city_id' => 'nullable|exists:cities,id',
        ];
    }
}
