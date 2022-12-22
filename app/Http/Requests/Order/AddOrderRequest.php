<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class AddOrderRequest extends FormRequest
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
            'customer_name'     => 'required',
            'bill_phone'       => ['required', 'regex:' . config('define.regex.phone')],
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required'     => 'Tên người nhận chưa được nhập',
            'bill_phone.required'   => trans('common.validation.phone.required'),
            'bill_phone.regex'      => trans('common.validation.phone.regex'),
        ];
    }
}
