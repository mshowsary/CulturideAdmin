<?php

namespace App\Http\Requests;

use App\Models\Phone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePhoneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('phone_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
