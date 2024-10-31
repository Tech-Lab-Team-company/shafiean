<?php

namespace App\Http\Requests\Organization;

use Illuminate\Validation\Rule;
use App\Rules\CityBelongsToCountry;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->id;
        // dd($id);

        return [
            'id' => 'required|exists:organizations,id',
            'name' => 'nullable|string|max:191',
            'licence_number' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:191',
                Rule::unique('organizations', 'email')->ignore($id),
            ],
            'address' => 'nullable|string|max:191',
            'country_id' => 'nullable|exists:countries,id',
            // 'city_id' => 'nullable|exists:cities,id',
            'city_id' => ['required', new CityBelongsToCountry($this->input('country_id'))],

            'manager_name' => 'nullable|string|max:191',
            'manager_phone' => 'nullable|string|max:191',
            'manager_email' => 'nullable|string|email|max:191|unique:organizations,manager_email,' . $id,
        ];
    }
}
