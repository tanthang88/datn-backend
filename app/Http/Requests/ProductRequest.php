<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name'     => 'required|min:6|max:255|unique:products,product_name,'.$this->id,
            'supplier_id'      => 'required',
            'product_quantity' => 'required|integer|min:1',
            'product_order'    => 'required|min:0',
            'category_id'      => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required'     => 'Tên sản phẩm chưa được nhập',
            'product_name.min'          => 'Tên sản phẩm quá ngắn',
            'product_name.unique'       => 'Tên sản phẩm đã tồn tại',
            'product_name.max'          => 'Tên sản phẩm quá dài',

            'supplier_id.required'    => 'Nhà cung cấp chưa chọn',

            'product_quantity.required'    => 'Số lượng kho chưa nhập',
            'product_quantity.min'         => 'Số lượng kho tối thiểu là 1',

            'product_order.required'    => 'Số thứ tự chưa nhập',
            'product_order.min'         => 'Số thứ tự là 0',

            'category_id.required'    => 'Danh mục chưa chọn',


        ];
    }
}
