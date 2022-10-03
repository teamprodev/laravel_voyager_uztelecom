@extends('site.layouts.app')
@section('center_content')
    <div id="section" class="pt-6">
        <a href="{{route('site.applications.create')}}"
           class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
            {{ __('Создать') }}
        </a>
        <div class="w-11/12 mx-auto pt-8 pb-16">

            {{ Aire::open()
      ->route('site.applications.performer_status_post')
      ->enctype("multipart/form-data")
      ->post() }}
            <div
                style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
                {{Aire::select($status, 'select', 'Статус')->value(Illuminate\Support\Facades\Cache::get('performer_status_get'))->name('performer_status_get')}}

                <button type="submit" class="btn btn-success" style="margin-top: 8px;">{{ __("Выбрать") }}</button>
            </div>
            {{ Aire::close() }}
            @if(Illuminate\Support\Facades\Cache::get('performer_status_get') != null)
                <table id="yajra-datatable">
                    <thead>
                    <tr>
                        <th>{{ __('ФИО') }}</th>
                        <th>{{ __('Инициатор (наименование подразделения заказчика)') }}</th>
                        <th>{{ __('Наименование предмета закупки(товар, работа, услуги)') }}</th>
                        <th>{{ __('Ожидаемый срок поставки') }}</th>
                        <th>{{ __('Планируемый бюджет закупки (сумма)') }}</th>
                        <th>{{ __('Условия поставки по INCOTERMS (самовывоз со склада/доставка до покупателя)') }}</th>
                        <th>{{ __('Дата создания') }}</th>
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
                    order: [[0, "desc"]],
                    processing: true,
                    serverSide: true,
                    ajax:
                        "{{ route('site.applications.performer_status') }}",

                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'name', name: 'name'},
                        {data: 'delivery_date', name: 'delivery_date'},
                        {
                            "data": "",
                            render: function (data, type, row) {
                                var details = row.planned_price + " " + row.currency;
                                return details;
                            }
                        },
                        {data: 'incoterms', name: 'incoterms'},

                        {data: 'created_at', name: 'created_at'},
                        {
                            "data": "status",
                            render: function (data, type, row) {
                                var details = JSON.parse(row.status).backgroundColor;
                                var color = JSON.parse(row.status).color;
                                var app = JSON.parse(row.status).app;
                                console.log(JSON.parse(row.status).app);
                                return `<button style='background-color: ${details};color:${color};width: 100%;height:100%' class='btn btn-lg'>`+app+`</button>`;
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ]
                });


            });
            if (document.getElementById('status').value === 'Исполнена') {
                document.getElementById('status').style.backgroundColor = green;
            }
            console.log(document.getElementById('status'))
        </script>
    @endpush
    @endif
@endsection
