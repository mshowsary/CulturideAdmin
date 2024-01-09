<?php

namespace App\Http\Requests;

use App\Models\Carpooling;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarpoolingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('carpooling_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:carpoolings,id',
        ];
    }
}
