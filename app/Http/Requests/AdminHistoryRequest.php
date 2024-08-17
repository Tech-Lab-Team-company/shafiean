<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminHistoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'admin_id' => 'nullable|exists:admins,id',
            'creatable_type' => 'nullable|string',
            'editable_type' => 'nullable|string',
            'model_id' => 'nullable|integer',
            'type' => 'nullable|string|max:191',
            'order' => 'nullable|string|max:191',
        ];
    }
}

