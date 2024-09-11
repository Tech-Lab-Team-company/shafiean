<?php

namespace App\Http\Requests\DisabilityType;

use Illuminate\Foundation\Http\FormRequest;

class DisabilityTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'nullable|exists:disability_types,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'order' => 'nullable|integer',
        ];
    }
}
