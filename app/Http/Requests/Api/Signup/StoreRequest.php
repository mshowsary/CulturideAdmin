<?php

namespace App\Http\Requests\Api\Signup;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'string',
                'unique:customers',
                'email',
                'required',
            ],
            'phone' => [
                'string',
                'required',
                'regex:/^(0)[6-7]{1}[0-9]{8}$/'
            ],
            'password' => [
                'string',
                'confirmed',
                'required',
                'min:6'
            ],
        ];
    }
}
