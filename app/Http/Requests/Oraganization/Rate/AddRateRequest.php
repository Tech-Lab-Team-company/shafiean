<?php

namespace App\Http\Requests\Oraganization\Rate;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddRateRequest extends ApiRequest
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
            'session_id' => 'required|exists:group_stage_sessions,id',
            'user_id' => 'required|exists:users,id',
            'student_understanding' => 'required',
            's_understanding_comment' => 'required',
            'student_performance' => 'required',
            's_performance_comment' => 'required',
        ];
    }
}
