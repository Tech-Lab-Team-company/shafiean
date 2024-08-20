<?php

namespace App\Http\Requests\Ayat;

use Illuminate\Foundation\Http\FormRequest;

class AyatUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $ayatId = $this->route('id');

        return [
            'quraan_id' => 'nullable|exists:quraan,id',
            'number' => 'nullable|integer',
        ];
    }
}
