<?php
namespace App\Http\Requests\Term;

use Illuminate\Foundation\Http\FormRequest;

class TermStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'timestamp' => 'required|date',
            'type' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'curriculum_id' => 'nullable|exists:curriculums,id',
            'disability_type_id' => 'nullable|exists:disability_types,id',
        ];
    }
}
