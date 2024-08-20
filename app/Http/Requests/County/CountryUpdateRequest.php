<?php
namespace App\Http\Requests\County;

use Illuminate\Foundation\Http\FormRequest;

class CountryUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $countryId = $this->route('id');

        return [
            'title' => 'required|string|max:255',
        ];
    }
}
