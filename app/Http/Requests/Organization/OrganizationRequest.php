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
            'website_link' => 'nullable|string|max:191',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'phone' => 'required|string|max:191',
            'email' => 'nullable|string|email|max:191',
            'address' => 'nullable|string|max:191',
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'manager_name' => 'required|string|max:191',
            'manager_phone' => 'required|string|max:191',
            'manager_email' => 'nullable|string|email|max:191|unique:organizations,manager_email',
            'disability_ids' => 'nullable|array',
            'for_all_disabilities' => 'nullable|integer',
        ];
    }
}
