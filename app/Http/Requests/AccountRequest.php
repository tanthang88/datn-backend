<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'password' => [
                'nullable', 'min:8', 'max:20', 'confirmed',
                'required_with:password_confirmation', '
            regex:' . config('define.regex.password'),
            ],
            'gender' => 'nullable|in:' . implode(',', User::GENDER),
            'address' => 'nullable|string',
            'dist_id' => 'nullable|numeric',
            'city_id' => 'nullable|numeric',
        ];
    }

    /**
     * messages
     *
     * @return string
     */
    public function messages()
    {
        return [
            'password.regex' => trans('common.validation.password.regex'),
            'gender.in' => trans('common.validation.gender.in'),
        ];
    }

}
