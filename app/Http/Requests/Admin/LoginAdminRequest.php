<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginAdminRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'password' => ['required','max:16','min:6','regex:'.config('define.regex.password')]
        ];
    }

    /**
     * messages
     *
     * @return string
     */
    public function messages()
    {
        return [
            'email.required' => trans('common.validation.email.required'),
            'email.email' => trans('common.validation.email.format'),
            'password.required' => trans('common.validation.password.required'),
            'password.max' => trans('common.validation.password.max'),
            'password.min' => trans('common.validation.password.min'),
            'password.regex' => trans('common.validation.password.regex'),
            'birthday.required' => trans('common.validation.birthday.required'),
        ];
    }
}
