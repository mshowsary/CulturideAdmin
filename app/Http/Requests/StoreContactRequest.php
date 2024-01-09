<?php

namespace App\Http\Requests;

use App\Models\Contact;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContactRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_create');
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
