@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ticket.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.id') }}
                        </th>
                        <td>
                            {{ $ticket->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.seat') }}
                        </th>
                        <td>
                            {{ $ticket->seat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.codebar') }}
                        </th>
                        <td>
                            {{ $ticket->codebar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.used') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $ticket->used ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.customer') }}
                        </th>
                        <td>
                            {{ $ticket->customer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ticket.fields.zone') }}
                        </th>
                        <td>
                            {{ $ticket->zone->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tickets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection