<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'between:2,20',
            'email' => 'required|email|unique:users',
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
