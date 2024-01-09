<?php

namespace App\Http\Requests\Api\Account;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class updatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => [
                'string',                
                'required',
                'min:6'
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
