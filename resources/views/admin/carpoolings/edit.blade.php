@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.carpooling.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carpoolings.update", [$carpooling->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="seat">{{ trans('cruds.carpooling.fields.seat') }}</label>
                <input class="form-control {{ $errors->has('seat') ? 'is-invalid' : '' }}" type="number" name="seat" id="seat" value="{{ old('seat', $carpooling->seat) }}" step="1" required>
                @if($errors->has('seat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpooling.fields.seat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.carpooling.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ old('status', $carpooling->status) }}" required>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpooling.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="codebar">{{ trans('cruds.carpooling.fields.codebar') }}</label>
                <input class="form-control {{ $errors->has('codebar') ? 'is-invalid' : '' }}" type="text" name="codebar" id="codebar" value="{{ old('codebar', $carpooling->codebar) }}">
                @if($errors->has('codebar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('codebar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpooling.fields.codebar_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('used') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="used" id="used" value="1" {{ $carpooling->used || old('used', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="used">{{ trans('cruds.carpooling.fields.used') }}</label>
                </div>
                @if($errors->has('used'))
                    <div class="invalid-feedback">
                        {{ $errors->first('used') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpooling.fields.used_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.carpooling.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $carpooling->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpooling.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ticket_id">{{ trans('cruds.carpooling.fields.ticket') }}</label>
                <select class="form-control select2 {{ $errors->has('ticket') ? 'is-invalid' : '' }}" name="ticket_id" id="ticket_id" required>
                    @foreach($tickets as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ticket_id') ? old('ticket_id') : $carpooling->ticket->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ticket') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpooling.fields.ticket_helper') }}</span>
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