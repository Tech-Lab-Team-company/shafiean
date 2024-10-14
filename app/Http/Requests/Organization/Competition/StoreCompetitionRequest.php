<?php

namespace App\Http\Requests\Organization\Competition;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitionRequest extends ApiRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today|date_format:Y-m-d',
            'end_date' => 'required|date|after:start_date|date_format:Y-m-d',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
