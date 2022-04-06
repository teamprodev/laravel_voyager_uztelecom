@extends('site.layouts.app')
@section('center_content')
    <h2 class="ml-5 pt-8">
        {{ __('lang.drafts') }}
    </h2>
        <div class="w-11/12 mx-auto pt-8 pb-16">
            <table class="data-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>{{ __('lang.table_1') }}</th>
                    <th>{{ __('lang.table_2') }}</th>
                    <th>{{ __('lang.table_3') }}</th>
                    <th>{{ __('lang.table_4') }}</th>
                    <th>{{ __('lang.table_5') }}</th>
                    <th>{{ __('lang.table_6') }}</th>
                    <th>{{ __('lang.table_7') }}</th>
                    <th>{{ __('lang.table_8') }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(function () {

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    searchable: true,
                    ajax:
                        "{{ route('site.applications.drafts') }}",
                    columns: [
                        {data: 'id', name: 'id'},
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
                            searchable: true,
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
