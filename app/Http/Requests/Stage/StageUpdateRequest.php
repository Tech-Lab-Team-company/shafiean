<?php
namespace App\Http\Requests\Stage;

use Illuminate\Foundation\Http\FormRequest;

class StageUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        $stageId = $this->route('id');

        return [
            'title' => [
                'nullable',
                'string',
                'max:255',

            ],
            'type' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'disability_type_id' => 'nullable|exists:disability_types,id',
        ];
    }
}
