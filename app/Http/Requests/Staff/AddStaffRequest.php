<?php

namespace App\Http\Requests\Staff;

use Illuminate\Foundation\Http\FormRequest;

class AddStaffRequest extends FormRequest
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
            'email' => 'required|email|max:255|min:5|unique:admin_users',
            'name' => 'required|string|regex:' . config('define.regex.name'),
            'tel' => ['required', 'regex:' . config('define.regex.phone')],
            'role' => 'required',
            'birthday' => 'required',
            'password' => ['required','max:16','min:6','regex:'.config('define.regex.password')]
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'email.required' => trans('common.validation.email.required'),
            'email.email' => trans('common.validation.email.format'),
            'email.max' => trans('common.validation.email.max'),
            'email.min' => trans('common.validation.email.min'),
            'email.unique' => trans('common.validation.email.unique'),
            'name.required' => trans('common.validation.name.required'),
            'name.regex' => trans('common.validation.name.regex'),
            'tel.required' => trans('common.validation.phone.required'),
            'tel.regex' => trans('common.validation.phone.regex'),
            'role.required' => trans('common.validation.role.required'),
            'password.required' => trans('common.validation.password.required'),
            'password.max' => trans('common.validation.password.max'),
            'password.min' => trans('common.validation.password.min'),
            'password.regex' => trans('common.validation.password.regex'),
            'birthday.required' => trans('common.validation.birthday.required'),
        ];
    }
}
