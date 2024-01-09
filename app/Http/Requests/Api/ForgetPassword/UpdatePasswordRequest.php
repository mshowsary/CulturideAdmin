<?php

namespace App\Http\Requests\Api\ForgetPassword;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [         
            'password' => [
                'string',
                'confirmed',
                'required',
                'min:6'
            ],
        ];
    }
}
