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
            'product_price'    => 'required|min:2|max:8',
            'product_quantity' => 'required|integer|min:1',
            'product_order'    => 'required|min:0',
            // 'config_screen'    => 'required',
            // 'config_cpu'       => 'required',
            // 'config_ram'       => 'required',
            // 'config_camera'    => 'required',
            // 'config_selfie'    => 'required',
            // 'config_battery'   => 'required',
            // 'config_system'    => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'product_name.required'     => 'Tên sản phẩm chưa được nhập',
            'product_name.min'          => 'Tên sản phẩm quá ngắn',
            'product_name.unique'       => 'Tên sản phẩm đã tồn tại',
            'product_name.max'          => 'Tên sản phẩm quá dài',

            'product_price.required'    => 'Giá sản phẩm chưa nhập',
            'product_price.min'         => 'Giá tối thiểu 2 chữ số',
            'product_price.max'         => 'Giá tối đa 8 chữ số',

            'product_quantity.required'    => 'Số lượng kho chưa nhập',
            'product_quantity.min'         => 'Số lượng kho tối thiểu là 1',

            'product_order.required'    => 'Số thứ tự chưa nhập',
            'product_order.min'         => 'Số thứ tự là 0',

            'config_screen.required'    => 'Màn hình chưa nhập',
            'config_cpu.required'       => 'CPU chưa nhập',
            'config_camera.required'    => 'Ram chưa nhập',
            'config_ram.required'       => 'Camera sau chưa nhập',
            'config_selfie.required'    => 'Camera trước chưa nhập',
            'config_battery.required'   => 'Thẻ nhớ ngoài chưa nhập',
            'config_system.required'    => 'Hệ điều hành chưa nhập',
        ];
    }
}
