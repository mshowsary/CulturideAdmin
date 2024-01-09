@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.carpooling.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpoolings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.id') }}
                        </th>
                        <td>
                            {{ $carpooling->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.seat') }}
                        </th>
                        <td>
                            {{ $carpooling->seat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.status') }}
                        </th>
                        <td>
                            {{ $carpooling->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.codebar') }}
                        </th>
                        <td>
                            {{ $carpooling->codebar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.used') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $carpooling->used ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.city') }}
                        </th>
                        <td>
                            {{ $carpooling->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.carpooling.fields.ticket') }}
                        </th>
                        <td>
                            {{ $carpooling->ticket->seat ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.carpoolings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection