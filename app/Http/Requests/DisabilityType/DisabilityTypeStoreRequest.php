<?php
namespace App\Http\Requests\DisabilityType;

use Illuminate\Foundation\Http\FormRequest;

class DisabilityTypeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ];
    }
}
