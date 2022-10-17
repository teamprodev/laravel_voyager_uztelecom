@extends('site.layouts.app')
@section('center_content')
    <h2 class="ml-5 pt-8">
        {{ __('Черновик') }}
    </h2>
    <div class="w-11/12 mx-auto pt-8 pb-16">
        <table class="data-table display wrap">
            <thead>
            <tr>
                <th>id</th>
                <th>№</th>
                <th>{{ __('Инициатор (наименование подразделения заказчика)') }}</th>
                <th>{{ __('Наименование предмета закупки(товар, работа, услуги)') }}</th>
                <th>{{ __('Ожидаемый срок поставки') }}</th>
                <th>{{ __('Планируемый бюджет закупки (сумма)') }}</th>
                <th>{{ __('Условия поставки по INCOTERMS') }}</th>
                <th>{{ __('Дата создания') }}</th>
                <th>{{ __('Статус заявки') }}</th>
                <th>{{ __('Действие') }}</th>
            </tr>
            </thead>
        </table>
    </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(function () {
                var table = $('.data-table').DataTable({
                    order: [[0, "desc"]],
                    processing: true,
                    serverSide: true,
                    searchable: true,
                    ajax:
                        "{{ route('site.applications.drafts.show_draft_getData') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'number', name: 'number'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'name', name: 'name'},
                        {data: 'delivery_date', name: 'delivery_date'},
                        {
                            data: 'planned_price_curr', name: 'planned_price_curr', render: function (data, type, row) {
                                if (row.planned_price === null || row.planned_price==="" ) return `{{ __('not_filled') }}`;
                                return row.planned_price + ' ' + row.currency;
                            }
                        },
                        {data: 'incoterms', name: 'incoterms'},

                        {data: 'created_at', name: 'created_at'},
                        {
                            "data": "status",
                            "name": "status",
                        },
                        {
                            data: 'action',
                            name: 'action',
                            render: function (link) {
                                return JSON.parse(link).link;
                            },
                            orderable: true,
                            searchable: true,
                        },
                    ]
                });
            });
        </script>
    @endpush
@endsection
