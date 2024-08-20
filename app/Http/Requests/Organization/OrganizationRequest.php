<?php

namespace App\Http\Requests\Organization;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:191',
            'licence_number' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:191',
            'email' => 'nullable|string|email|max:191',
            'address' => 'nullable|string|max:191',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'manager_name' => 'nullable|string|max:191',
            'manager_phone' => 'nullable|string|max:191',
            'manager_email' => 'nullable|string|email|max:191',
        ];
    }
}

