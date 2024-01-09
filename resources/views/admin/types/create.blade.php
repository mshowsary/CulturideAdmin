@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.type.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.type.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.type.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="categories">{{ trans('cruds.type.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple required>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('categories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.type.fields.category_helper') }}</span>
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