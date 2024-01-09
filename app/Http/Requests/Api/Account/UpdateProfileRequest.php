<?php

namespace App\Http\Requests\Api\Account;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class updateProfileRequest extends FormRequest
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
            // 'email' => [
            //     'string',                
            //     'required',
                
            // ],
            'phone' => [
                'string',                
                'required',
                'regex:/^(0)[6-7]{1}[0-9]{8}$/'
                
            ],            
        ];
    }
}
