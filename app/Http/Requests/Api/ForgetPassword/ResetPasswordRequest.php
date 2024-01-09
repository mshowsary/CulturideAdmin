<?php

namespace App\Http\Requests\Api\ForgetPassword;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [ 
            'email' => [
                'string',
                'exists:customers',
                'email',
                'required',
            ],            
        ];
    }
}
