@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.carpoolingRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.carpooling-requests.update", [$carpoolingRequest->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('accepted') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="accepted" id="accepted" value="1" {{ $carpoolingRequest->accepted || old('accepted', 0) === 1 ? 'checked' : '' }} required>
                    <label class="required form-check-label" for="accepted">{{ trans('cruds.carpoolingRequest.fields.accepted') }}</label>
                </div>
                @if($errors->has('accepted'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accepted') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingRequest.fields.accepted_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seat">{{ trans('cruds.carpoolingRequest.fields.seat') }}</label>
                <input class="form-control {{ $errors->has('seat') ? 'is-invalid' : '' }}" type="number" name="seat" id="seat" value="{{ old('seat', $carpoolingRequest->seat) }}" step="1" required>
                @if($errors->has('seat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingRequest.fields.seat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="carpooling_id">{{ trans('cruds.carpoolingRequest.fields.carpooling') }}</label>
                <select class="form-control select2 {{ $errors->has('carpooling') ? 'is-invalid' : '' }}" name="carpooling_id" id="carpooling_id" required>
                    @foreach($carpoolings as $id => $entry)
                        <option value="{{ $id }}" {{ (old('carpooling_id') ? old('carpooling_id') : $carpoolingRequest->carpooling->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('carpooling'))
                    <div class="invalid-feedback">
                        {{ $errors->first('carpooling') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingRequest.fields.carpooling_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ticket_id">{{ trans('cruds.carpoolingRequest.fields.ticket') }}</label>
                <select class="form-control select2 {{ $errors->has('ticket') ? 'is-invalid' : '' }}" name="ticket_id" id="ticket_id" required>
                    @foreach($tickets as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ticket_id') ? old('ticket_id') : $carpoolingRequest->ticket->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ticket') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.carpoolingRequest.fields.ticket_helper') }}</span>
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