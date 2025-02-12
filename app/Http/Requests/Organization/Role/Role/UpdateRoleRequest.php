<?php

namespace App\Http\Requests\Organization\Role\Role;



use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends ApiRequest
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
        // dd($this->name);
        return [
            'id' => 'required|exists:roles,id',
            'name' => 'nullable',
            'description' => 'nullable',
            'display_name' => 'required',
            'modules' => 'required|array',
            'modules.*.id' => 'required|exists:modules,id',
            'modules.*.name' => 'required',
            'modules.*.maps' => 'required|array',
            'modules.*.maps.*.id' => 'required|exists:maps,id',
            'modules.*.maps.*.name' => 'required',
        ];
    }
}
