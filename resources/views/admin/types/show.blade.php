@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.type.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.type.fields.id') }}
                        </th>
                        <td>
                            {{ $type->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type.fields.name') }}
                        </th>
                        <td>
                            {{ $type->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.type.fields.category') }}
                        </th>
                        <td>
                            @foreach($type->categories as $key => $category)
                                <span class="label label-info">{{ $category->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection