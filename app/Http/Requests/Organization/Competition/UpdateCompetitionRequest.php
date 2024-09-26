<?php

namespace App\Http\Requests\Organization\Competition;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompetitionRequest extends ApiRequest
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
            'id' => 'required|exists:competitions,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|after:start_date|date_format:Y-m-d',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
