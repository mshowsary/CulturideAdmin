@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carpoolingRequest.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpooling-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.id') }}
                        </th>
                        <td>
                            {{ $carpoolingRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.accepted') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $carpoolingRequest->accepted ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.seat') }}
                        </th>
                        <td>
                            {{ $carpoolingRequest->seat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.carpooling') }}
                        </th>
                        <td>
                            {{ $carpoolingRequest->carpooling->seat ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.ticket') }}
                        </th>
                        <td>
                            {{ $carpoolingRequest->ticket->seat ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpooling-requests.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection