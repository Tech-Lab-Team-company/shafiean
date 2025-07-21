<?php

namespace App\Http\Requests\Auth;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationLoginRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'credentials' => 'nullable|string|required_without:email',
            'email' => 'nullable|string|email|exists:teachers,email',
            'password' => 'required|string|min:6',
        ];
    }
}
