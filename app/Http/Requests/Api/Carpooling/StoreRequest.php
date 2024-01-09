<?php

namespace App\Http\Requests\Api\Carpooling;

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
            'parent' => [
                'integer',
                'required',
            ],
            'carpoolings' => [
                'array',                
                'required',
                
            ],
        ];
    }
}
