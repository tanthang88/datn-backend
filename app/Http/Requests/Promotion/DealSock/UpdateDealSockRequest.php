<?php

namespace App\Http\Requests\Promotion\DealSock;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealSockRequest extends FormRequest
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
            'dealsock_name' => 'required'.$this->id,
             'dealsock_daterange' => [
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
            'dealsock_numberofuse' =>'required|integer|min:1'
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
            'dealsock_name.required' => trans('common.validation.discoutcode_name.required'),
            'dealsock_name.unique' => trans('common.validation.discoutcode_name.unique'),
             'dealsock_name_daterange.required' => trans('common.validation.discoutcode_daterange.required'),
            'dealsock_numberofuse.required' => trans('common.validation.discoutcode_numberofuse.required'),
            'dealsock_numberofuse.integer' => trans('common.validation.discoutcode_numberofuse.integer'),
            'dealsock_numberofuse.min' => trans('common.validation.discoutcode_numberofuse.min'),
        ];
    }
}
