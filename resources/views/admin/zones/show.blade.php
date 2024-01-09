@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.zone.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.zone.fields.id') }}
                        </th>
                        <td>
                            {{ $zone->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zone.fields.name') }}
                        </th>
                        <td>
                            {{ $zone->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zone.fields.seat') }}
                        </th>
                        <td>
                            {{ $zone->seat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zone.fields.sold_seat') }}
                        </th>
                        <td>
                            {{ $zone->sold_seat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zone.fields.price') }}
                        </th>
                        <td>
                            {{ $zone->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.zone.fields.event') }}
                        </th>
                        <td>
                            {{ $zone->event->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.zones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection