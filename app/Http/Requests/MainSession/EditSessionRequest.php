<?php

namespace App\Http\Requests\MainSession;

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
        return [
            "id" => "required|exists:main_sessions,id",
            "title" => "nullable|string|max:255",
            "stage_id" => "nullable|exists:stages,id",
            "quraan_id" => "nullable|exists:quraan,id",
            "session_type_id" => "nullable|exists:session_types,id",
            "organization_id" => "nullable|exists:organizations,id",
            "start_verse" => "nullable",
            "end_verse" => "nullable",
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'حقل المعرف مطلوب.',
            'id.exists' => 'المعرف المدخل غير موجود في الجلسات الرئيسية.',
            'title.string' => 'عنوان الجلسة يجب أن يكون نصًا.',
            'title.max' => 'عنوان الجلسة لا يمكن أن يتجاوز 255 حرفًا.',
            'stage_id.exists' => 'المعرف المدخل غير موجود في المراحل.',
            'quraan_id.exists' => 'المعرف المدخل غير موجود في القرآن.',
            'session_type_id.exists' => 'المعرف المدخل غير موجود في أنواع الجلسات.',
            'organization_id.exists' => 'المعرف المدخل غير موجود في المنظمات.',
        ];
    }
}
