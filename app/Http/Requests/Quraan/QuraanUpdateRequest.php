<?php
namespace App\Http\Requests\Quraan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuraanUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $quraanId = $this->route('quraan');

        return [
            'title' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('quraans')->ignore($quraanId),
            ],
            'order' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ];
    }
}
