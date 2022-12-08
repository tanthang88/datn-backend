<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'company_name'     => 'required|min:3|max:255',
            'company_email' => ['required', 'string', 'email', 'max:255'],
            'company_phone' => ['required', 'regex:' . config('define.regex.phone')],
            'company_address'=>'required',
            'company_hotline' => ['required', 'regex:' . config('define.regex.phone')],
            'company_work_day'=>'required',
            'company_work_time'=>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'company_name'     =>'Tên công ty không được trống',
            'company_email.required' => trans('common.validation.email.required'),
            'company_email.email' => trans('common.validation.email.format'),
            'company_email.max' => trans('common.validation.email.max'),
            'company_phone.required' => trans('common.validation.phone.required'),
            'company_phone.regex' => trans('common.validation.phone.regex'),
            'company_address'=>'Địa chỉ không được trống',
            'company_hotline.required' => trans('common.validation.phone.required'),
            'company_hotline.regex' => trans('common.validation.phone.regex'),
            'company_work_time'     =>'Thời gian làm việc không được trống',
            'company_work_day'     =>'Ngày làm việc  không được trống',
        ];
    }
}
