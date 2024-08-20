<?php
namespace App\Http\Requests\Term;

use Illuminate\Foundation\Http\FormRequest;

class TermUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $termId = $this->route('id');

        return [
            'timestamp' => 'nullable|date',
            'type' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'curriculum_id' => 'nullable|exists:curriculums,id',
            'disability_type_id' => 'nullable|exists:disability_types,id',
        ];
    }
}
