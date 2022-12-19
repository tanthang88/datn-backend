<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class AddBannerRequest extends FormRequest
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
            'title'        => 'required|unique:banners,title',
            'image'     => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'    => 'Banner chưa được nhập',
            'title.unique'      => 'Banner đã tồn tại',
            'image'             =>'Hình ảnh chưa chọn',
        ];
    }
}
