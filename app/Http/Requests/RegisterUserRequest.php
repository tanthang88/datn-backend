<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
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
            'email.max' => trans('common.validation.email.max'),
            'email.unique' => trans('common.validation.email.unique'),
            'password.required' => trans('common.validation.email.required'),
        ];
    }
}
