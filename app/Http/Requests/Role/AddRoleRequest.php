<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'display_name' => 'required',
            'permission_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('common.validation.role.name.required'),
            'display_name.required' => trans('common.validation.role.display_name.required'),
            'permission_id.required' => trans('common.validation.role.permission.required'),
        ];
    }
}
