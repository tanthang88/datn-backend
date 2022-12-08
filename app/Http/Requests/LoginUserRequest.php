<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'password' => 'required',
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
        ];
    }

}
