<?php

namespace App\Http\Requests\Organization\MainSession;


use App\Enum\SessionIsNewEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddSessionRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "title" => ['required_if:is_new,1'],
            "stage_id" => "required|exists:stages,id",
            "teacher_id" => "required|exists:teachers,id",
            'session_id' => ['required_if:is_new,0', 'nullable', 'exists:main_sessions,id'],
            "session_type_id" => "nullable|exists:session_types,id",
            "surah_id" => "required|exists:surahs,id",
            'start_ayah_id' => 'required|exists:ayahs,id',
            'end_ayah_id' => 'required|exists:ayahs,id',
            'is_new' => 'required|boolean|in:' . enumCaseValue(SessionIsNewEnum::class),
            'group_id' => 'nullable|exists:groups,id',
            'duration' => 'nullable|numeric',
            'date' => 'nullable|date|date_format:Y-m-d',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->start_ayah_id && $this->end_ayah_id && $this->start_ayah_id == $this->end_ayah_id) {
                $validator->errors()->add('start_ayah_id', 'بدايه الايه يجب ان لا يتطابق مع نهاية الايه');
            }
        });
    }
}
