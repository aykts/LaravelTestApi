<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email' => 'required|email|max:200',
            'password' => 'required|between:3,20',
        ];
    }

    public function messages()
    {
        return [
            'password.between' => __('validation.between.numeric', ['min' => 3,'max' => 20]),
        ];
    }
}
