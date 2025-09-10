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

class AddReportsRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
public function rules(): array
{
    return [
        'reports' => 'required|array',
        'reports.*.date' => 'required|date|date_format:Y-m-d',
        'reports.*.session_type_id' => 'required|exists:session_types,id',
        'reports.*.type' => ['required', Rule::enum(ReportTypeEnum::class)],
        'reports.*.user_id' => [
            'required',
            Rule::exists('users', 'id')->where('type', UserTypeEnum::STUDENT->value),
        ],
        'reports.*.degree' => 'required|numeric|min:0|max:20',
        'reports.*.is_absent' => 'nullable|boolean',
        'reports.*.stage_id' => 'nullable|exists:stages,id',
        'reports.*.teacher_id' => 'nullable|exists:teachers,id',
        'reports.*.session_id' => 'nullable|exists:main_sessions,id',
        'reports.*.group_id' => 'nullable|exists:groups,id',

        // quraan validation
        'reports.*.from_surah_id' => [
            'nullable',
            'required_if:reports.*.type,' . ReportTypeEnum::QURAAN->value,
            Rule::exists('surahs', 'id')
        ],
        'reports.*.from_ayah_id' => 'required_with:reports.*.from_surah_id|exists:ayahs,id',
        'reports.*.to_surah_id' => [
            'nullable',
            'required_with:reports.*.from_surah_id',
            Rule::exists('surahs', 'id')
        ],
        'reports.*.to_ayah_id' => 'required_with:reports.*.to_surah_id|exists:ayahs,id',
    ];
}

public function withValidator($validator)
{
    $validator->after(function ($validator) {
        foreach ($this->reports ?? [] as $index => $report) {
            if (!empty($report['from_surah_id']) && !empty($report['from_ayah_id'])) {
                $from_surah = Surah::find($report['from_surah_id']);
                $from_ayah  = Ayah::find($report['from_ayah_id']);

                if ($from_surah && $from_ayah && $from_surah->id !== $from_ayah->surah_id) {
                    $validator->errors()->add("reports.$index.from_ayah_id", 'بدايه الايه يجب ان يتوافق مع السورة المحددة');
                }
            }

            if (!empty($report['to_surah_id']) && !empty($report['to_ayah_id'])) {
                $to_surah = Surah::find($report['to_surah_id']);
                $to_ayah  = Ayah::find($report['to_ayah_id']);

                if ($to_surah && $to_ayah && $to_surah->id !== $to_ayah->surah_id) {
                    $validator->errors()->add("reports.$index.to_ayah_id", 'نهاية الايه يجب ان يتوافق مع السورة المحددة');
                }
            }
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
