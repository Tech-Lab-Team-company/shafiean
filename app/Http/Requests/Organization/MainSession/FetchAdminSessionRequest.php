<?php

namespace App\Http\Requests\Organization\MainSession;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchAdminSessionRequest extends ApiRequest
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
            'stage_ids' => 'nullable|array',
            'stage_ids.*' => 'integer|exists:stages,id',
            'curriculum_ids' => 'nullable|array',
            'curriculum_ids.*' => 'integer|exists:curriculums,id',
            'disability_ids' => 'nullable|array',
            'disability_ids.*' => 'integer|exists:disability_types,id',
        ];
    }
}
