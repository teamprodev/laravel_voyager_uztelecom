@extends('site.layouts.app')
@section('center_content')
<div id="section" class="pt-6">
    <a href="{{route('site.applications.create')}}"
        class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
        {{ __('lang.create') }}
    </a>
    <div class="w-11/12 mx-auto pt-8 pb-16">
        <table id="yajra-datatable">
            <thead>
            <tr>
                <th>№</th>
                <th>{{ __('lang.table_1') }}</th>
                <th>{{ __('lang.table_2') }}</th>
                <th>{{ __('lang.table_3') }}</th>
                <th>{{ __('lang.table_4') }}</th>
                <th>{{ __('lang.table_5') }}</th>
                <th>{{ __('lang.table_6') }}</th>
                <th>{{ __('lang.table_7') }}</th>
                <th class="w-100">{{ __('lang.table_8') }}</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        var table = $('#yajra-datatable').DataTable({
            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            ajax:
                 "{{ route('site.applications.index') }}",

            columns: [
                {data: 'number', name: 'number'},
                {data: 'initiator', name: 'initiator'},
                {data: 'name', name: 'name'},
                {data: 'delivery_date', name: 'delivery_date'},
                {
                    "data": "",
                    render: function (data, type, row) {
                            var details = row.planned_price + " " + row.currency ;
                                return details;
                        }
                },
                {data: 'incoterms', name: 'incoterms'},

                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });


  });

</script>
@endpush
@endsection
