<?php

namespace App\Http\Requests\SessionType;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditSessionTypeRequest extends ApiRequest
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
            "id" => "required|exists:session_types,id",
            "title" => "nullable|string",
            "organization_id" => "nullable|exists:organizations,id",
        ];
    }
}
