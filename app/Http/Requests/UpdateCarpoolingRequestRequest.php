<?php

namespace App\Http\Requests;

use App\Models\CarpoolingRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCarpoolingRequestRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('carpooling_request_edit');
    }

    public function rules()
    {
        return [
            'accepted' => [
                'required',
            ],
            'seat' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'carpooling_id' => [
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
