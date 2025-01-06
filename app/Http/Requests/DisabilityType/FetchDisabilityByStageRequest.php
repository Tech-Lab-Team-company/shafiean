<?php

namespace App\Http\Requests\DisabilityType;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchDisabilityByStageRequest extends ApiRequest
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
            'stage_ids' => 'array|exists:stages,id'
        ];
    }
}
