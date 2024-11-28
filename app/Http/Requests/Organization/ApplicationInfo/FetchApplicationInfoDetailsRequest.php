<?php

namespace App\Http\Requests\Organization\ApplicationInfo;

use App\Helpers\Response\ApiRequest;
use App\Enum\ApplicationInfoTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class FetchApplicationInfoDetailsRequest extends ApiRequest
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
            // 'id' => 'required',
            'type' => 'required|numeric|in:' . enumCaseValue(ApplicationInfoTypeEnum::class),
        ];
    }
}
