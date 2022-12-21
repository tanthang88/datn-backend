<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'subject' => 'required',
            'content' => 'required',
            'customer_name' => 'required',
            'phone' => ['required','regex:' . config('define.regex.phone')],
            'email' => ['required', 'string', 'email', 'max:255'],
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
            'subject.required' => trans('common.validation.subject.required'),
            'content.required' => trans('common.validation.content.required'),
            'customer_name.required' => trans('common.validation.name.required'),
            'phone.required' => trans('common.validation.phone.required'),
            'phone.regex' => trans('common.validation.phone.regex'),
            'email.required' => trans('common.validation.email.required'),
            'email.email' => trans('common.validation.email.format'),
            'email.max' => trans('common.validation.email.max'),
        ];
    }
}
