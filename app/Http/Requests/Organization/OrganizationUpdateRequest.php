<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrganizationUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->id;

        return [
            'name' => 'required|string|max:191',
            'licence_number' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:191',
                Rule::unique('organizations')->ignore($id),
            ],
            'address' => 'nullable|string|max:191',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'manager_name' => 'nullable|string|max:191',
            'manager_phone' => 'nullable|string|max:191',
            'manager_email' => 'nullable|string|email|max:191|unique:organizations,manager_email,except,id',
        ];
    }
}
