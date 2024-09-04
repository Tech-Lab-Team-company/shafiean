<?php

namespace App\Http\Requests\Stage;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditStageRequest extends ApiRequest
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
            "id" => "required|exists:stages,id",
            "title" => "nullable|string|max:255",
            "description" => "nullable|string|max:255",
            "currculum_id" => "nullable|exists:curriculums,id",
            "disability_ids" => "nullable|array|exists:disability_types,id",
            "quraan_ids" => "nullable|array|exists:quraan,id",
        ];
    }
}
