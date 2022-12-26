<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $rules = [
            'product_name'     => 'required|min:6|max:255|unique:products,product_name,'.$this->id,
            'supplier_id'      => 'required',
            'product_quantity' => 'required|integer|min:1',
            'category_id'      => 'required',
            'is_variation' => 'numeric',
            'product_price' => 'required_if:is_variation,==,0',
        ];

        if($this->is_configuration_product == 'on') {
          $rules['config_screen']=['required','regex:'.config('define.regex.decimal')];
          $rules['config_cpu']=['required','string'];
          $rules['config_ram']=['required','integer'];
          $rules['config_camera']=['required','regex:'.config('define.regex.decimal')];
          $rules['config_selfie']=['required','regex:'.config('define.regex.decimal')];
          $rules['config_battery']=['required','integer'];
          $rules['config_system']=['required','string'];
        }
        return $rules;
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
            'product_price.required_if' =>  'Giá sản phẩm chưa nhập',
            'category_id.required'    => 'Danh mục chưa chọn',

            'config_screen.required' => 'Màn hình chưa nhập',
            'config_screen.regex' => 'Vui lòng nhập đúng định dạng',
            'config_cpu.required' => 'CPU chưa nhập',
            'config_cpu.string' => 'Vui lòng nhập đúng định dạng',
            'config_ram.required' => 'Ram chưa nhập',
            'config_ram.integer' => 'Vui lòng nhập đúng định dạng',
            'config_camera.required' => 'Camera sau chưa nhập',
            'config_camera.regex' => 'Vui lòng nhập đúng định dạng',
            'config_selfie.required' => 'Camera trước chưa nhập',
            'config_selfie.regex' => 'Vui lòng nhập đúng định dạng',
            'config_battery.required' => 'Pin chưa nhập',
            'config_battery.integer' => 'Vui lòng nhập đúng định dạng',
            'config_system.required' => 'Hệ điều hành chưa nhập',
            'config_system.string' => 'Vui lòng nhập đúng định dạng',
        ];
    }
}
