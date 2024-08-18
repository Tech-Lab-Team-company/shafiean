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
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'order' => 'required|integer',
            'disability_type_id' => 'nullable|exists:disability_types,id',
        ];
    }
}

