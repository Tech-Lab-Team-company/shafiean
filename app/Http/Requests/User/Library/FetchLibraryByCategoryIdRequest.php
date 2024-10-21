<?php

namespace App\Http\Requests\User\Library;


use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchLibraryByCategoryIdRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'library_category_id' => 'required|exists:library_categories,id',
        ];
    }
}
