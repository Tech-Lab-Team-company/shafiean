<?php

namespace App\Http\Requests\Organization\MainSession;

use App\Enum\CanEditSessionEnum;
use App\Enum\SessionIsNewEnum;
use App\Models\GroupStageSession;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditSessionRequest extends ApiRequest
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
        $session = GroupStageSession::find(request()->id);
        $data = [
            "id" => "required|exists:group_stage_sessions,id",
            "title" => ['required_if:is_new' . ',' .  CanEditSessionEnum::CAN->value],
            "teacher_id" => "required|exists:teachers,id",
            "session_type_id" => "nullable|exists:session_types,id",
            'duration' => 'nullable|numeric',
            'date' => 'nullable|date|date_format:Y-m-d',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'is_new' => ['required', 'boolean', 'in:' . enumCaseValue(CanEditSessionEnum::class)],
        ];

        if ($session && $session->with_edit == CanEditSessionEnum::CAN->value) {
            $data = array_merge($data, [
                // 'session_id' => ['required', 'exists:main_sessions,id'],
                "stage_id" => "required|exists:stages,id",
                "surah_id" => "required|exists:surahs,id",
                'start_ayah_id' => 'required|exists:ayahs,id',
                'end_ayah_id' => 'required|exists:ayahs,id',
            ]);
        }
        return $data;
    }

    public function messages(): array
    {
        return [
            'id.required' => 'حقل المعرف مطلوب.',
            'id.exists' => 'المعرف المدخل غير موجود في الجلسات الرئيسية.',
            'title.string' => 'عنوان الجلسة يجب أن يكون نصًا.',
            'title.max' => 'عنوان الجلسة لا يمكن أن يتجاوز 255 حرفًا.',
            'title.required_if' => 'عنوان الحصة مطلوب.',
            'stage_id.exists' => 'المعرف المدخل غير موجود في المراحل.',
            'quraan_id.exists' => 'المعرف المدخل غير موجود في القرآن.',
            'session_type_id.exists' => 'المعرف المدخل غير موجود في أنواع الجلسات.',
            'organization_id.exists' => 'المعرف المدخل غير موجود في المنظمات.',
        ];
    }
}
