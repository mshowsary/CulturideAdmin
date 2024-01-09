@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.zone.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.zones.update", [$zone->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.zone.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $zone->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="seat">{{ trans('cruds.zone.fields.seat') }}</label>
                <input class="form-control {{ $errors->has('seat') ? 'is-invalid' : '' }}" type="number" name="seat" id="seat" value="{{ old('seat', $zone->seat) }}" step="1" required>
                @if($errors->has('seat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('seat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.seat_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.zone.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $zone->price) }}" step="0.01" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_id">{{ trans('cruds.zone.fields.event') }}</label>
                <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                    @foreach($events as $id => $entry)
                        <option value="{{ $id }}" {{ (old('event_id') ? old('event_id') : $zone->event->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zone.fields.event_helper') }}</span>
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