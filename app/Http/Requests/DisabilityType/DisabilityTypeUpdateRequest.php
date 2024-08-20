<?php
namespace App\Http\Requests\DisabilityType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DisabilityTypeUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $disabilityTypeId = $this->route('id');

        return [
            'title' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('disability_types')->ignore($disabilityTypeId),
            ],
            'order' => 'nullable|integer',
        ];
    }
}
