<?php

namespace App\Http\Requests\Store;

use App\Http\Requests\BaseFormRequest;

class StoreRequest extends BaseFormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'owner_email' => 'required|email|unique:stores|email|max:50',
            'owner_password' => 'required|between:3,20',
            'name' => 'required|between:2,20',
            'url' => 'required|url|unique:stores',
            'status' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.between' => __('validation.between.numeric', ['min' => 2,'max' => 20]),
            'owner_password.between' => __('validation.between.numeric', ['min' => 3,'max' => 20]),
        ];
    }
}
