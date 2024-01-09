<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTicketRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ticket_edit');
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
            'codebar' => [
                'string',
                'required',
                'unique:tickets,codebar,' . request()->route('ticket')->id,
            ],
            'used' => [
                'required',
            ],
            'customer_id' => [
                'required',
                'integer',
            ],
            'zone_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
