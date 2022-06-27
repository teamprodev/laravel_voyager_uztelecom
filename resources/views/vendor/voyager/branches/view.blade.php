@extends('site.layouts.app')
@section('center_content')
    <div id="section" class="pt-6">
        <a href="{{route('site.applications.create')}}"
           class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
            {{ __('Создать') }}
        </a>
        <div class="w-11/12 mx-auto pt-8 pb-16">

            {{ Aire::open()
      ->route('branches.putCache')
      ->enctype("multipart/form-data")
      ->post() }}
            <div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
                {{Aire::select($branch, 'select', 'Филиал')->value(Illuminate\Support\Facades\Cache::get(auth()->user()->id))->name('branch_id')}}

                <button type="submit" class="btn btn-success" style="margin-top: 8px;">Выбрать</button>
            </div>
            {{ Aire::close() }}
            @if(Illuminate\Support\Facades\Cache::get(auth()->user()->id) != null)
                <table id="yajra-datatable" class="display wrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Заявки')}}</th>
                        <th>{{ __('Дата заявки')}}</th>
                        <th>{{ __('Инициатор (наименование подразделения заказчика)') }}</th>
                        <th>{{ __('Филиал') }}</th>
                        <th>{{ __('Наименование предмета закупки(товар, работа, услуги)') }}</th>
                        <th>{{ __('Ожидаемый срок поставки') }}</th>
                        <th>{{ __('Планируемый бюджет закупки (сумма)') }}</th>
                        <th>{{ __('Условия поставки по INCOTERMS') }}</th>
                        <th>{{ __('Дата создания') }}</th>
                        <th>{{ __('Дата обновления') }}</th>
                        <th>{{ __('Статус заявки') }}</th>
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
                            targets: [0,1,2,3,4,5,6,8,9,10,11,12],
                            className: 'dt-body-center dt-head-center'
                        },
                        {
                            targets: 7,
                            className: 'dt-body-right dt-head-center'
                        }
                    ],
                    order: [[ 0, "desc" ]],
                    processing: true,
                    serverSide: true,
                    ajax:
                        "/branches/ajax_branch",

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'number', name: 'number'},
                        {data: 'date', name: 'date'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'branch_initiator_id', name: 'branch_initiator_id'},
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
                        {data: 'updated_at', name: 'updated_at'},
                        {data: 'status', name: 'status'},
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
