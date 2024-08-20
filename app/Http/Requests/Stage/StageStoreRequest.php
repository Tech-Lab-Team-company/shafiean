<?php
namespace App\Http\Requests\Stage;

use Illuminate\Foundation\Http\FormRequest;

class StageStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'disability_type_id' => 'nullable|exists:disability_types,id',
        ];
    }
}
