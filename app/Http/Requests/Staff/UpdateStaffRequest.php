<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
        $rule = [
            'name' => 'required|string|regex:' . config('define.regex.name'),
            'birthday' => 'required',
            'tel' => ['required', 'regex:' . config('define.regex.phone')],
            'role' => 'required',
            'is_change_password' => 'required|boolean',
            'password' => [
                'nullable',
                'required_if:is_change_password,true',
            ]
        ];
        $rule['password'][] = 'max:16';
        $rule['password'][] = 'min:6';
        $rule['password'][] = 'regex:' . config('define.regex.password');

        return $rule;
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'name.required' => trans('common.validation.name.required'),
            'name.regex' => trans('common.validation.name.regex'),
            'tel.required' => trans('common.validation.phone.required'),
            'tel.regex' => trans('common.validation.phone.regex'),
            'role.required' => trans('common.validation.role.required'),
            'password.required_if' => trans('common.validation.password.required'),
            'password.max' => trans('common.validation.password.max'),
            'password.min' => trans('common.validation.password.min'),
            'password.regex' => trans('common.validation.password.regex'),
            'birthday.required' => trans('common.validation.birthday.required'),
        ];
    }
}
