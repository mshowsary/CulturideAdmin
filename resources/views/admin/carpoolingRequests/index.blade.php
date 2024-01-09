@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.carpoolingRequest.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CarpoolingRequest">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.accepted') }}
                        </th>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.seat') }}
                        </th>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.carpooling') }}
                        </th>
                        <th>
                            {{ trans('cruds.carpoolingRequest.fields.ticket') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($carpoolings as $key => $item)
                                    <option value="{{ $item->seat }}">{{ $item->seat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($tickets as $key => $item)
                                    <option value="{{ $item->seat }}">{{ $item->seat }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carpoolingRequests as $key => $carpoolingRequest)
                        <tr data-entry-id="{{ $carpoolingRequest->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $carpoolingRequest->id ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $carpoolingRequest->accepted ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $carpoolingRequest->accepted ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $carpoolingRequest->seat ?? '' }}
                            </td>
                            <td>
                                {{ $carpoolingRequest->carpooling->seat ?? '' }}
                            </td>
                            <td>
                                {{ $carpoolingRequest->ticket->seat ?? '' }}
                            </td>
                            <td>
                                @can('carpooling_request_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.carpooling-requests.show', $carpoolingRequest->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('carpooling_request_delete')
                                    <form action="{{ route('admin.carpooling-requests.destroy', $carpoolingRequest->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('carpooling_request_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.carpooling-requests.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CarpoolingRequest:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection