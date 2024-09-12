<?php

namespace App\Http\Requests\Course;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchCoursesRequest extends ApiRequest
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
            'word' => 'nullable|string|max:191',
            'year_ids' => 'nullable|array|exists:years,id',
            'curriculum_ids' => 'nullable|array|exists:curriculums,id',
        ];
    }
}
