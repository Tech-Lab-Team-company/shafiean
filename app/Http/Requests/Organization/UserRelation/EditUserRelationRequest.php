<?php

namespace App\Http\Requests\Organization\UserRelation;


use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class EditUserRelationRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:user_relations,id',
        ];
    }
}
