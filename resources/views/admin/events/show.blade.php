@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.name') }}
                        </th>
                        <td>
                            {{ $event->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.cover') }}
                        </th>
                        <td>
                            @if($event->cover)
                                <a href="{{ $event->cover->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->cover->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.description') }}
                        </th>
                        <td>
                            {!! $event->description !!}
                        </td>
                    </tr>
                    @can('role_create')
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.home') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $event->home ? 'checked' : '' }}>
                        </td>
                    </tr>
                    @endcan
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.date') }}
                        </th>
                        <td>
                            {{ $event->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.time') }}
                        </th>
                        <td>
                            {{ $event->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.city') }}
                        </th>
                        <td>
                            {{ $event->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.artist') }}
                        </th>
                        <td>
                            {{ $event->artist->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.category') }}
                        </th>
                        <td>
                            {{ $event->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.type') }}
                        </th>
                        <td>
                            {{ $event->type->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection