<?php

namespace App\Http\Requests\Api\Signin;

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
            'email' => [
                'string',                
                'email',
                'required',
            ],
            'password' => [
                'string',                
                'required',
                'min:6'
            ],
        ];
    }
}
