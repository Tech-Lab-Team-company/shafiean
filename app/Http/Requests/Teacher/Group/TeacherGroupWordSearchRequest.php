<?php

namespace App\Http\Requests\Teacher\Group;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class TeacherGroupWordSearchRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'word' => 'nullable',
        ];
    }
}
