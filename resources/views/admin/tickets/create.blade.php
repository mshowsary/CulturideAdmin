@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ticket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tickets.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="seat">{{ trans('cruds.ticket.fields.seat') }}</label>
                <input class="form-control {{ $errors->has('seat') ? 'is-invalid' : '' }}" type="number" name="seat" id="seat" value="{{ old('seat', '') }}" step="1" required>
                @if($errors->has('seat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.seat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="codebar">{{ trans('cruds.ticket.fields.codebar') }}</label>
                <input class="form-control {{ $errors->has('codebar') ? 'is-invalid' : '' }}" type="text" name="codebar" id="codebar" value="{{ old('codebar', '') }}" required>
                @if($errors->has('codebar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('codebar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.codebar_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('used') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="used" id="used" value="1" required {{ old('used', 0) == 1 ? 'checked' : '' }}>
                    <label class="required form-check-label" for="used">{{ trans('cruds.ticket.fields.used') }}</label>
                </div>
                @if($errors->has('used'))
                    <div class="invalid-feedback">
                        {{ $errors->first('used') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.used_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.ticket.fields.customer') }}</label>
                <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" required>
                    @foreach($customers as $id => $entry)
                        <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="zone_id">{{ trans('cruds.ticket.fields.zone') }}</label>
                <select class="form-control select2 {{ $errors->has('zone') ? 'is-invalid' : '' }}" name="zone_id" id="zone_id" required>
                    @foreach($zones as $id => $entry)
                        <option value="{{ $id }}" {{ old('zone_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('zone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('zone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection