<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeShipRequest extends FormRequest
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
            'about_name'     => 'required|min:3|max:255|unique:abouts,about_name,' . $this->id,
            'transport_fee'    => 'integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'about_name.required'     => 'Tên khu vực chưa được nhập',
            'about_name.min'          => 'Tên khu vực quá ngắn',
            'about_name.unique'       => 'Tên khu vực đã tồn tại',
            'about_name.max'          => 'Tên khu vực quá dài',
            'transport_fee.integer' => 'Phí ship là số dương',
            'transport_fee.min' => 'Phí ship phải là số dương'
        ];
    }
}
