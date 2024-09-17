<?php

namespace App\Http\Requests\MainSession;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddSessionRequest extends ApiRequest
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
            "title" => "required|string",
            "stage_id" => "required|exists:stages,id",
            "quraan_id" => "required|exists:quraan,id",
            // "session_type_id" => "required|exists:session_types,id",
            "organization_id" => "nullable|exists:organizations,id",
            "start_verse" => "nullable",
            "end_verse" => "nullable",
        ];
    }
}
