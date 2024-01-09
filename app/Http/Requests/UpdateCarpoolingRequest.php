<?php

namespace App\Http\Requests;

use App\Models\Carpooling;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCarpoolingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carpooling_edit');
    }

    public function rules()
    {
        return [
            'seat' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'status' => [
                'string',
                'required',
            ],
            'codebar' => [
                'string',
                'nullable',
            ],
            'used' => [
                'required',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'ticket_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
