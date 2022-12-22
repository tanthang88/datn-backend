<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class AddSliderRequest extends FormRequest
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
            'title'        => 'required|unique:sliders,title',
            'image'     => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'    => 'Slider chưa được nhập',
            'title.unique'      => 'Slider đã tồn tại',
            'image'             =>'Hình ảnh chưa chọn',
        ];
    }
}