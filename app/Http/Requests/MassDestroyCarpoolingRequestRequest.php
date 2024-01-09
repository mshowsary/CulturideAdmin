<?php

namespace App\Http\Requests;

use App\Models\CarpoolingRequest;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCarpoolingRequestRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('carpooling_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:carpooling_requests,id',
        ];
    }
}
