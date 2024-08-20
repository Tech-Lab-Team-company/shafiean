<?php
namespace App\Http\Requests\County;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
        ];
    }
}
