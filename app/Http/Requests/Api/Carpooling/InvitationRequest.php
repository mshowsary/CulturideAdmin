<?php

namespace App\Http\Requests\Api\Carpooling;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class InvitationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [ 
            'status' => [
                'string',                
                'required',                
            ],
        ];
    }
}
