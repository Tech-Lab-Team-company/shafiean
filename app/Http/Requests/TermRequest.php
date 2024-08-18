<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'timestamp' => 'required|date',
            'type' => 'required|string|max:255',
            'order' => 'required|integer',
            'curriculum_id' => 'required|exists:curriculums,id',
            'disability_type_id' => 'required|exists:disability_types,id',
        ];
    }
}

