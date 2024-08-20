<?php

namespace App\Http\Requests\Curriculum;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:191',
            'type' => 'nullable|integer',
            'time' => 'nullable|string|max:191',
            'from' => 'nullable|date',
            'to' => 'nullable|date|after_or_equal:from',
            'order' => 'nullable|string',
            'curriculum_id' => 'nullable|exists:curriculums,id',
        ];
    }
}

