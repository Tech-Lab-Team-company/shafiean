<?php

namespace App\Http\Requests\MainSession;

use App\Enum\SessionIsNewEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchMainSessionStageRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "session_id" => ['required_if:is_new,0', 'nullable', 'exists:main_sessions,id'],
            'is_new' => 'required|boolean|in:' . enumCaseValue(SessionIsNewEnum::class),
            'course_id' => ['required_if:is_new,1', 'nullable', 'exists:courses,id'],
        ];
    }
}
