@extends('site.layouts.app')
@section('center_content')
    <head>
        <style>
            .dt-body-center, .dt-body-right{
                font-size: 0.8rem;
            }
            .btn{
                font-size: 0.9rem !important;
                padding: 2px !important;
            }
            .btn-sm{
                font-size: 0.75rem !important;
                padding: 3px !important;
            }
            thead>tr>th.sorting, table.dataTable thead>tr>th.sorting_asc, table.dataTable thead>tr>th.sorting_desc, table.dataTable thead>tr>th.sorting_asc_disabled, table.dataTable thead>tr>th.sorting_desc_disabled, table.dataTable thead>tr>td.sorting, table.dataTable thead>tr>td.sorting_asc, table.dataTable thead>tr>td.sorting_desc, table.dataTable thead>tr>td.sorting_asc_disabled, table.dataTable thead>tr>td.sorting_desc_disabled{
                padding-right: 0 !important;
            }
        </style>
    </head>
    <div id="section" class="pt-6">
        <a href="{{route('site.applications.create')}}"
           class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
            {{ __('Создать') }}
        </a>
        <div class="pt-8 pb-16">

            {{ Aire::open()
      ->route('branches.putCache')
      ->enctype("multipart/form-data")
      ->post() }}
            <div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
                {{Aire::select($branch, 'select', 'Филиал')->value(auth()->user()->select_branch_id)->name('branch_id')}}

                <button type="submit" class="btn btn-success" style="margin-top: 8px;">Выбрать</button>
            </div>
            {{ Aire::close() }}
            @if(Illuminate\Support\Facades\Cache::get(auth()->user()->id) != null)
                <table id="yajra-datatable" class="display wrap responsive" style="width: 100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Статус заявки') }}</th>
                        <th>{{__('Визирование заявки через:') }}</th>
                        <th>{{ __('Заявки')}}</th>
                        <th>{{ __('Дата заявки')}}</th>
                        <th>{{ __('Инициатор (наименование подразделения заказчика)') }}</th>
                        <th>{{ __('Филиал') }}</th>
                        <th>{{ __('Наименование предмета закупки(товар, работа, услуги)') }}</th>
                        <th>{{ __('Ожидаемый срок поставки') }}</th>
                        <th>{{ __('Планируемый бюджет закупки (сумма)') }}</th>
                        <th>{{ __('Условия поставки по INCOTERMS') }}</th>
                        <th>{{ __('Дата создания') }}</th>
                        <th>{{ __('Действие') }}</th>
                    </tr>
                    </thead>
                </table>
        </div>
    </div>
    @push('scripts')
        <script>
            $(function () {
                var table = $('#yajra-datatable').DataTable({
                    columnDefs: [
                        {
                            targets: [0,1,2,3,4,5,6,7,9,10],
                            className: 'dt-body-center dt-head-center'
                        },
                        {
                            targets: 8,
                            className: 'dt-body-right dt-head-center'
                        },
                    ],
                    order: [[ 0, "desc" ]],
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "{{ __('Все') }}"] ] ,
                    processing: true,
                    serverSide: true,
                    ajax:
                        "/branches/ajax_branch",

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'status', name: 'status'},
                        {data: 'is_more_than_limit', name: 'is_more_than_limit'},
                        {data: 'number', name: 'number'},
                        {data: 'date', name: 'date'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'branch_initiator_id', name: 'branch_initiator_id'},
                        {data: 'name', name: 'name'},
                        {data: 'delivery_date', name: 'delivery_date'},
                        {data: 'planned_price_curr', name: 'planned_price_curr'},
                        {data: 'incoterms', name: 'incoterms'},
                        {data: 'created_at', name: 'created_at'},
                        {
                            data: 'action',
                            name: 'action',
                        },
                    ]
                });


            });
            if(document.getElementById('status').value === 'Исполнена')
            {
                document.getElementById('status').style.backgroundColor = green;
            }
            console.log(document.getElementById('status'))
        </script>
    @endpush
    @endif
@endsection
