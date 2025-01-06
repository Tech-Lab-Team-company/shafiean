<?php
namespace App\Http\Requests\Organization\MainSession;


use App\Enum\SessionIsNewEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AddSessionRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "stage_id" => "required|exists:stages,id",
            "surah_id" => "required|exists:surahs,id",
            'session_id' => ['required_if:is_new,0', 'exists:main_sessions,id'],
            // "session_type_id" => "required|exists:session_types,id",
            "organization_id" => "nullable|exists:organizations,id",
            'start_ayah_id' => 'required|exists:ayahs,id',
            'end_ayah_id' => 'required|exists:ayahs,id',
            'is_new' => 'nullable|boolean|in:' . enumCaseValue(SessionIsNewEnum::class),

        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->start_ayah_id && $this->end_ayah_id && $this->start_ayah_id == $this->end_ayah_id) {
                $validator->errors()->add('start_ayah_id', 'بدايه الايه يجب ان لا يتطابق مع نهاية الايه');
            }
        });
    }
}
