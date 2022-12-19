<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'product_name'     => 'required|min:6|max:255|unique:products,product_name',
            'supplier_id'      => 'required',
            'product_quantity' => 'required|integer|min:1',
            'category_id'      => 'required',
            'is_variation' => 'numeric',
            'product_price' => 'required_if:is_variation,==,0',
            'propertie_name' => 'required_if:is_variation,==,1',

        ];
    }
    public function messages()
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
            'product_price.required_if' =>  'Giá sản phẩm chưa nhập',
            'propertie_name.required_if' =>  'Thuộc tính chưa nhập',
            'category_id.required'    => 'Danh mục chưa chọn',


        ];
    }
}
