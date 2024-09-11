<?php

namespace App\Http\Requests\Stage;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddStageRequest extends ApiRequest
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
            'title' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'curriculum_id' => 'required|exists:curriculums,id',
            'disability_ids' => 'required|array|exists:disability_types,id',
            'quraan_ids' => 'nullable|array|exists:quraan,id',
        ];
    }
}
