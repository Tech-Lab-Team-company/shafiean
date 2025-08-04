<?php

namespace App\Http\Requests\Organization\AttendenceReport;


use App\Enum\UserTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddMutipleReportsRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "reports" => 'required|array',
            "reports.*.user_id" => [
                "required",
                'distinct',
                "integer",
                Rule::exists('users', 'id')->where('type', UserTypeEnum::STUDENT->value),
            ],
            "reports.*.date" => 'required|date|date_format:Y-m-d',
            "reports.*.notes" => 'nullable|string',
            "reports.*.is_absent" => 'nullable|boolean',            
            'report_id' => 'nullable|exists:reports,id',
        ];
    }
}
