<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|regex:' . config('define.regex.name'),
            'tel' => ['required', 'regex:' . config('define.regex.phone')],
            'address' => 'required',
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
            'name.required' => trans('common.validation.name.required'),
            'name.regex' => trans('common.validation.name.regex'),
            'tel.required' => trans('common.validation.phone.required'),
            'tel.regex' => trans('common.validation.phone.regex'),
            'address' => trans('common.validation.address.required'),
        ];
    }
}
