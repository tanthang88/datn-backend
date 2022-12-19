<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class AddPostRequest extends FormRequest
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
            'post_name'     => 'required|unique:posts,post_name',
            'category_id'   => 'required',
        ];
    }
    public function messages()
    {
        return [
            'post_name.required'     => 'Tên bài viết chưa được nhập',
            'post_name.unique'     => 'Tên bài viết đã tồn tại',
            'category_id.required'     => 'Danh mục chưa được chọn',
        ];
    }
}
