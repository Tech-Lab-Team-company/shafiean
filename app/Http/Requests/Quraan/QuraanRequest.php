<?php

namespace App\Http\Requests\Quraan;

use Illuminate\Foundation\Http\FormRequest;

class QuraanRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust authorization logic as needed
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'order' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ];
    }
}

