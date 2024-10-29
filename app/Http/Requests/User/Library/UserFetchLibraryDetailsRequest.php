<?php

namespace App\Http\Requests\User\Library;

use App\Helpers\Response\ApiRequest;

class UserFetchLibraryDetailsRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:libraries,id',
        ];
    }
}
