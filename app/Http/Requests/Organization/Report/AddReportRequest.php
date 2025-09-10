<?php

namespace App\Http\Requests\Organization\Report;


use App\Enum\SessionIsNewEnum;
use App\Enum\UserTypeEnum;
use App\Helpers\Response\ApiRequest;
use App\Models\Ayah;
use App\Models\Surah\Surah;
use App\Enum\ReportTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddReportRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        // $rules = $this->rules();
        return [
            // 'reports' => 'required|array',
            'date' => 'required|date|date_format:Y-m-d',
            "session_type_id" => "required|exists:session_types,id",
            'type' => [
                'required',
                Rule::enum(ReportTypeEnum::class)
            ],
            "user_id" => [
                "required",
                Rule::exists('users', 'id')->where('type', UserTypeEnum::STUDENT->value),
            ],
            "degree" => "required|numeric|min:0|max:20",
            'is_absent' => 'nullable|boolean',
            "stage_id" => "nullable|exists:stages,id",
            "teacher_id" => "nullable|exists:teachers,id",
            'session_id' => ['nullable', 'exists:main_sessions,id'],
            'group_id' => 'nullable|exists:groups,id',

            // validation for quraan
            "from_surah_id" => [
                'nullable',
                'required_if:type,' . ReportTypeEnum::QURAAN->value,
                Rule::exists('surahs', 'id')
            ],
            'from_ayah_id' => 'required|exists:ayahs,id',
            "to_surah_id" => [
                'nullable',
                'required_with:from_surah_id',
                Rule::exists('surahs', 'id')
            ],
            'to_ayah_id' => 'required|exists:ayahs,id',
            'notes' => 'nullable|string',
            //validation for other non quran here
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->from_surah_id && $this->from_ayah_id) {
                $from_surah = Surah::find($this->from_surah_id);
                $from_ayah = Ayah::find($this->from_ayah_id);

                if ($from_surah->id !== $from_ayah->surah_id) {
                    $validator->errors()->add('from_ayah_id', 'بدايه الايه يجب ان يتوافق مع السورة المحددة');
                }
            } elseif ($this->from_surah_id && !$this->from_ayah_id) {
                $validator->errors()->add('from_ayah_id', 'يجب اختيار الايه البدايه');
            }
            if ($this->to_surah_id && $this->to_ayah_id) {
                $to_surah = Surah::find($this->to_surah_id);
                $to_ayah = Ayah::find($this->to_ayah_id);
                if ($to_surah->id !== $to_ayah->surah_id) {
                    $validator->errors()->add('to_ayah_id', 'نهاية الايه يجب ان يتوافق مع السورة المحددة');
                }
            } elseif ($this->to_surah_id && !$this->to_ayah_id) {
                $validator->errors()->add('to_ayah_id', 'يجب اختيار الايه النهاية');
            } elseif ($this->from_surah_id && !$this->to_surah_id && $this->to_ayah_id) {
                $from_surah = Surah::find($this->from_surah_id);
                $to_ayah = Ayah::find($this->to_ayah_id);
                if ($from_surah->id !== $to_ayah->surah_id) {
                    $validator->errors()->add('to_ayah_id', 'نهاية الايه يجب ان يتوافق مع السورة المحددة');
                }
            }

            if ($this->from_ayah_id && $this->to_surah_id && $this->from_ayah_id == $this->to_surah_id) {
                $validator->errors()->add('from_ayah_id', 'بدايه الايه يجب ان لا يتطابق مع نهاية الايه');
            }
        });
    }

    public function messages()
    {
        return [
            'from_surah_id.required_if' => 'يجب اختيار سورة بدايه عند اختيار التقرير قرأن',

        ];
    }
}
