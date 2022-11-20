<?php

namespace App\Http\Requests\Promotion\DiscountCode;

use Illuminate\Foundation\Http\FormRequest;

class AddDiscountRequest extends FormRequest
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
            'discoutcode_name' => 'required|unique:promotions,promotion_name',
             'discoutcode_code' => 'required|string|min:4|unique:promotion_products,promotion_code',
             'discoutcode_daterange' => [
                'required',
                function($attribute, $value, $fail){
                   $dateRanges = explode(' - ', $value);
                   $converts= convertStringToDateDiff($dateRanges[0],$dateRanges[1]);
                    $interval = date_diff($converts[0], $converts[1]);
                    $diffhour=$interval->format('%h');
                     if((int)$diffhour<1){
                        $fail('Thời gian kết thúc lớn hơn thời gian bắt đầu ít nhất 1 giờ');
                     }
                }
            ],
            'discoutcode_rate' => 'required|integer|min:1',
            'discoutcode_ordervalue' => 'required|integer|min:1',
            'discoutcode_numberofuse' =>'required|integer|min:1'
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'discoutcode_name.required' => trans('common.validation.discoutcode_name.required'),
            'discoutcode_name.unique' => trans('common.validation.discoutcode_name.unique'),
            'discoutcode_code.required' => trans('common.validation.discoutcode_code.required'),
             'discoutcode_code.min' => trans('common.validation.discoutcode_code.min'),
             'discoutcode_code.unique' => trans('common.validation.discoutcode_code.unique'),
             'discoutcode_daterange.required' => trans('common.validation.discoutcode_daterange.required'),
             'discoutcode_rate.required' => trans('common.validation.discoutcode_rate.required'),
             'discoutcode_rate.integer' => trans('common.validation.discoutcode_rate.integer'),
             'discoutcode_rate.min' => trans('common.validation.discoutcode_rate.min'),
            'discoutcode_ordervalue.required' => trans('common.validation.discoutcode_ordervalue.required'),
            'discoutcode_ordervalue.integer' => trans('common.validation.discoutcode_ordervalue.integer'),
            'discoutcode_ordervalue.min' => trans('common.validation.discoutcode_ordervalue.min'),
            'discoutcode_numberofuse.required' => trans('common.validation.discoutcode_numberofuse.required'),
            'discoutcode_numberofuse.integer' => trans('common.validation.discoutcode_numberofuse.integer'),
            'discoutcode_numberofuse.min' => trans('common.validation.discoutcode_numberofuse.min'),
        ];
    }
}
