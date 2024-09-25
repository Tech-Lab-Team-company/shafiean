<?php

namespace App\Http\Requests\Organization\UserRelation;


use Illuminate\Validation\Rule;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRelationRequest extends ApiRequest
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
            'relation_id' => 'required|exists:relations,id',
            'student_id' => [
                'required',
                'exists:users,id',
                Rule::unique('user_relations')->where(function ($query) {
                    return $query->where('user_id', $this->user_id);
                }),
                'different:user_id',
            ],
            'user_id' =>  [
                'required',
                'exists:users,id',
                Rule::unique('user_relations')->where(function ($query) {
                    return $query->where('student_id', $this->student_id);
                }),
                'different:student_id',
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'student_id.unique' => __('messages.student_id_unique'),
            'user_id.unique' => __('messages.student_id_unique'),
            'user_id.different' => __('messages.student_and_user_must_be_different'),
            'student_id.different' => __('messages.student_and_user_must_be_different'),
        ];
    }
}
