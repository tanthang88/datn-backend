<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
            'about_name'     => 'required|min:3|max:255|unique:abouts,about_name,'.$this->id,
            'type'           => 'required|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'about_name.required'     => 'Tên thông tin chưa được nhập',
            'about_name.min'          => 'Tên thông tin quá ngắn',
            'about_name.unique'       => 'Tên thông tin đã tồn tại',
            'about_name.max'          => 'Tên thông tin quá dài',

            'type.required'           => 'Loại chưa được nhập',
            'type.min'                => 'Loại quá ngắn',
            'type.max'                => 'Loại quá dài',

        ];
    }
}
