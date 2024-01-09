<?php

namespace App\Http\Requests\Api\Ticket;

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
            'zone' => [
                'integer',
                'required',
            ],
            'seats' => [
                'integer',           
                'required',
            ],
            'city' => [
                'integer',
                'required',
                'not_in:0',
            ],
            'carpooling' => [
                'array',                
                'required',
                
            ],
        ];
    }
}
