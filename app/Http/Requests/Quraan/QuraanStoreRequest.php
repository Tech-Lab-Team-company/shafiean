<?php
namespace App\Http\Requests\Quraan;

use Illuminate\Foundation\Http\FormRequest;

class QuraanStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'order' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
        ];
    }
}
