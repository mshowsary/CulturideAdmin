<?php

namespace App\Http\Requests\Api\Contact;

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
                'email',
                'required',
            ],
            'message' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'subject' => [
                'string',
                'required',
            ],
        ];
    }
}
