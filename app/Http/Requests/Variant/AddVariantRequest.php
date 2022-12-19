<?php

namespace App\Http\Requests\Variant;

use Illuminate\Foundation\Http\FormRequest;

class AddVariantRequest extends FormRequest
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
            'price'     => 'required',

        ];
    }
    public function messages()
    {
        return [
            'price.required'     => 'Biến thể chưa khởi tạo',

        ];
    }
}
