<?php

namespace App\Http\Requests\Organization\Report;

use App\Enum\CanEditSessionEnum;
use App\Enum\SessionIsNewEnum;
use App\Models\GroupStageSession;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditReportRequest extends ApiRequest
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
        return [];  
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
