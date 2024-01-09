@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.artist.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.id') }}
                        </th>
                        <td>
                            {{ $artist->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.name') }}
                        </th>
                        <td>
                            {{ $artist->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.photo') }}
                        </th>
                        <td>
                            @if($artist->photo)
                                <a href="{{ $artist->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $artist->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.description') }}
                        </th>
                        <td>
                            {!! $artist->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.link_facebook') }}
                        </th>
                        <td>
                            {{ $artist->link_facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.link_twitter') }}
                        </th>
                        <td>
                            {{ $artist->link_twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.artist.fields.link_insta') }}
                        </th>
                        <td>
                            {{ $artist->link_insta }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.artists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection