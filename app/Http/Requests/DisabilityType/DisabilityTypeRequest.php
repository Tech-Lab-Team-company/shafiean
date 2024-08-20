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
            'title' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ];
    }
}

