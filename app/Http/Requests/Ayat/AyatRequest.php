<?php

namespace App\Http\Requests\Ayat;

use Illuminate\Foundation\Http\FormRequest;

class AyatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'quraan_id' => 'nullable|exists:quraan,id',
            'number' => 'nullable|integer',
        ];
    }
}

