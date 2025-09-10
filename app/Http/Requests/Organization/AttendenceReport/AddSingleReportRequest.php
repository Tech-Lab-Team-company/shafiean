<?php

namespace App\Http\Requests\Organization\AttendenceReport;


use App\Enum\UserTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddSingleReportRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            "user_id" => [
                "required",
                Rule::exists('users', 'id')->where('type', UserTypeEnum::STUDENT->value),
            ],
            'is_absent' => 'required|boolean',
            'report_id' => 'nullable|exists:reports,id',
            'notes' => 'nullable|string',
        ];
    }
}
