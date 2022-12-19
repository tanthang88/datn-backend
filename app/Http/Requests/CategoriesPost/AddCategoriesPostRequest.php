<?php

namespace App\Http\Requests\CategoriesPost;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoriesPostRequest extends FormRequest
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
            'category_name'     => 'required|unique:product_categories,category_name',
        ];
    }
    public function messages()
    {
        return [
            'category_name.required'     => 'Tên danh mục chưa được nhập',
            'category_name.unique'     => 'Tên danh mục đã tồn tại',
        ];
    }
}
