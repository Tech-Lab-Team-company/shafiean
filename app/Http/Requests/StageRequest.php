<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'disability_type_id' => 'nullable|exists:disability_types,id',
        ];
    }
}

