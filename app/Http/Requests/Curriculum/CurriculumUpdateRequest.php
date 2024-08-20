<?php
namespace App\Http\Requests\Curriculum;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurriculumUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $curriculumId = $this->route('id');

        return [
            'title' => 'nullable|string|max:191',
            'type' => 'nullable|integer',
            'time' => 'nullable|string|max:191',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'order' => 'nullable|string',
            'curriculum_id' => [
                'nullable',
                'exists:curriculums,id',
                Rule::unique('curriculums')->ignore($curriculumId),
            ],
        ];
    }
}
