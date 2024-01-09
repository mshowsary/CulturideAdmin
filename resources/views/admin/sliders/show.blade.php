@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.slider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <td>
                            {{ $slider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.name') }}
                        </th>
                        <td>
                            {{ $slider->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.photo') }}
                        </th>
                        <td>
                            @if($slider->photo)
                                <a href="{{ $slider->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $slider->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $slider->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.position') }}
                        </th>
                        <td>
                            {{ $slider->position }}
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>
                            {{ trans('cruds.slider.fields.description') }}
                        </th>
                        <td>
                            {!! $slider->description !!}
                        </td>
                    </tr> -->
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection