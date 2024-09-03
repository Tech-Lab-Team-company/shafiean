<?php

namespace App\Http\Requests\Curriculum;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'word' => 'nullable|string|max:191',
        ];
    }
}
