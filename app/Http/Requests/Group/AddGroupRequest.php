<?php

namespace App\Http\Requests\Group;

use App\Helpers\Response\ApiRequest;
use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class AddGroupRequest extends ApiRequest
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
            'title' => 'required|string',
            'course_id' => 'required|exists:courses,id',
            // 'teacher_id' => 'required|exists:teachers,id',
            'start_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'before_or_equal:end_date',
                function ($attribute, $value, $fail) {
                    $course = Course::find(request()->course_id);

                    if (isset($course->start_date) && strtotime($value) < strtotime($course->start_date)) {
                        $fail("تاريخ البدء يجب ان يكون بعد تاريخ بدء الدورة");
                    } elseif (!isset($course->start_date)) {
                        $fail(__("messages.start_date_required"));
                    }
                }
            ],
            'end_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $course = Course::find(request()->course_id);
                    if (isset($course->end_date) && strtotime($value) > strtotime($course->end_date)) {
                        $fail("تاريخ النهاية يجب ان يكون قبل تاريخ نهاية الدورة");
                    } elseif (!isset($course->end_date)) {
                        $fail(__("messages.end_date_required"));
                    }
                }
            ],
            // 'with_all_disability' => 'required|integer',
            // 'with_all_course_content' => 'required|integer',
            // 'disabilities' => 'required_if:with_all_disability,0|array',
            // 'disabilities.*' => 'required_if:with_all_disability,0|exists:disability_types,id',
            // 'days' =>  'required|array',
            // 'days.*.day_id' => 'required|exists:days,id',
            // 'days.*.start_time' => 'required|date_format:H:i',
            // 'days.*.end_time' => 'required|date_format:H:i',
            // 'stages' => 'required_if:with_all_course_content,0|array',
            // 'stages.*' => 'required_if:with_all_course_content,0|exists:stages,id',
        ];
    }
}
