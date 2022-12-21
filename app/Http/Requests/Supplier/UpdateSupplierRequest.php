<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
            'supplier_name'        => 'required|unique:product_categories,supplier_name,'.$this->id,
            'supplier_address'     => 'required',
            'supplier_phone'       => ['required', 'regex:' . config('define.regex.phone')],
            'supplier_email'       => 'required|email|max:255',
        ];
    }
    public function messages()
    {
        return [
            'supplier_name.required'    => 'Nhà cung cấp chưa được nhập',
            'supplier_name.unique'    => 'Nhà cung cấp đã tồn tại',
            'supplier_address'          =>'Địa chỉ không được trống',
            'supplier_phone.required'   => trans('common.validation.phone.required'),
            'supplier_phone.regex'      => trans('common.validation.phone.regex'),
            'supplier_email.required'   => trans('common.validation.email.required'),
            'supplier_email.email'      => trans('common.validation.email.format'),
            'supplier_email.max'        => trans('common.validation.email.max'),
        ];
    }
}
