<?php

namespace App\Http\Requests;

use App\Models\Zone;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreZoneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('zone_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'seat' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'price' => [
                'numeric',
                'required',
            ],
            'event_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
