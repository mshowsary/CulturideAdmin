<?php

namespace App\Http\Requests;

use App\Models\Artist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArtistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('artist_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'unique:artists',
                'required',
            ],
            'link_facebook' => [
                'string',
                'nullable',
            ],
            'link_twitter' => [
                'string',
                'nullable',
            ],
            'link_insta' => [
                'string',
                'nullable',
            ],
        ];
    }
}
