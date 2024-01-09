<?php

namespace App\Http\Requests;

use App\Models\Type;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',                
                'unique:types,name,' . request()->route('type')->id,
                'required',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'required',
                'array',
            ],
        ];
    }
}
