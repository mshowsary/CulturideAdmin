<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'cover' => [
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'time' => [
                'string',
                'required',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'artist_id' => [
                'required',
                'integer',
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
