<?php

namespace App\Http\Requests;

use App\Models\Artist;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateArtistRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('artist_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',                
                'unique:artists,name,' . request()->route('artist')->id,
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
