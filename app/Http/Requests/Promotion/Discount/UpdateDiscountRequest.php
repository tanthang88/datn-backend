<?php

namespace App\Http\Requests\Promotion\Discount;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountRequest extends FormRequest
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
            'discout_name' => 'required'. $this->id,
            'discout_daterange' => [
                'required',
                function ($attribute, $value, $fail) {
                    $dateRanges = explode(' - ', $value);
                    $converts = convertStringToDateDiff($dateRanges[0], $dateRanges[1]);
                    $interval = date_diff($converts[0], $converts[1]);
                    $diffhour = $interval->format('%h');
                    if ((int)$diffhour < 1) {
                        $fail('Thời gian kết thúc lớn hơn thời gian bắt đầu ít nhất 1 giờ');
                    }
                }
            ],
            'discout_rate' => 'required|integer|min:1',
            'discout_numberofuse' => 'required|integer|min:1'
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
            'discout_name.required' => trans('common.validation.discoutcode_name.required'),
            'discout_daterange.required' => trans('common.validation.discoutcode_daterange.required'),
            'discout_rate.required' => trans('common.validation.discoutcode_rate.required'),
            'discout_rate.integer' => trans('common.validation.discoutcode_rate.integer'),
            'discout_rate.min' => trans('common.validation.discoutcode_rate.min'),
            'discout_numberofuse.required' => trans('common.validation.discoutcode_numberofuse.required'),
            'discout_numberofuse.integer' => trans('common.validation.discoutcode_numberofuse.integer'),
            'discout_numberofuse.min' => trans('common.validation.discoutcode_numberofuse.min'),
        ];
    }
}
