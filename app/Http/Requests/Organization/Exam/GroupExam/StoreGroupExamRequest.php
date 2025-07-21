<?php

namespace App\Http\Requests\Organization\Exam\GroupExam;

use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;

class StoreGroupExamRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'start_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
            // 'start_time' => 'required|date_format:H:i',
            // 'end_time' => 'required|date_format:H:i|after:start_time',
            'start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(now()->format('H:i'))) {
                        $fail("يجب أن يكون وقت البدء بعد الوقت الحالي أو يساويه.");
                    }
                },
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if (isset(request()->start_time) && strtotime($value) < strtotime(request()->start_time)) {
                        $fail("وقت النهاية يجب ان يكون بعد وقت البدأ");
                    }
                },
            ],
            'duration' => 'required|date_format:H:i',
            'group_id' => 'required|exists:groups,id',
            // 'question_count' => 'required|numeric',
            // 'exam_type' => 'required|numeric|in:' . enumCaseValue(ExamTypeEnum::class),
            // 'degree_type' => 'required|numeric|in:' . enumCaseValue(DegreeTypeEnum::class),
            // 'degree' => 'required|numeric',

        ];
    }
    public function messages(): array
    {
        return [
            'end_time.after' => 'يجب أن يكون وقت النهاية بعد وقت البداية.',
        ];
    }
}
