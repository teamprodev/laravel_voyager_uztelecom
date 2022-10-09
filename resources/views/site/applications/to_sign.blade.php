@extends('site.layouts.app')
@section('center_content')
    <div id="section" class="pt-6">
        <a href="{{route('site.applications.create')}}"
           class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
            {{ __('Создать') }}
        </a>
        <div class="w-11/12 mx-auto pt-8 pb-16">
            <table id="yajra-datatable">
                <thead>
                <tr>
                    <th>{{ __('ФИО') }}</th>
                    <th>{{ __('Инициатор (наименование подразделения заказчика)') }}</th>
                    <th>{{ __('Наименование предмета закупки(товар, работа, услуги)') }}</th>
                    <th>{{ __('Ожидаемый срок поставки') }}</th>
                    <th>{{ __('Планируемый бюджет закупки (сумма)') }}</th>
                    <th>{{ __('Условия поставки по INCOTERMS (самовывоз со склада/доставка до покупателя)') }}</th>
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
                            targets: "_all",
                            className: 'dt-body-center dt-head-center'
                        }],
                    order: [[0, "desc"]],
                    processing: true,
                    serverSide: true,
                    ajax:
                        "{{ route('site.applications.to_sign_data') }}",

                    columns: [
                        {data: 'user_id', name: 'user_id'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'name', name: 'name'},
                        {data: 'delivery_date', name: 'delivery_date'},
                        {
                            "data": "planned_price",
                            "name": "planned_price",
                            render: function (data, type, row) {
                                if (row.planned_price === null) return " "
                                return new Intl.NumberFormat('ru-RU').format(row.planned_price)  + ' ' + row.currency;
                            }
                        },
                        {data: 'incoterms', name: 'incoterms'},
                        {
                            data: 'status', name: 'status', render: function (data, type, row) {
                                var details = JSON.parse(row.status).backgroundColor;
                                var color = JSON.parse(row.status).color;
                                var app = JSON.parse(row.status).app;
                                return `<button style='background-color: ${details};color:${color};' class='btn-sm'>` + app + `</button>`;
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            render: function (link) {
                                return checkActionUser(JSON.parse(link));
                            },
                            orderable: true,
                            searchable: true
                        },
                    ]
                });


            });
            if (document.getElementById('status').value === 'Исполнена') {
                document.getElementById('status').style.backgroundColor = green;
            }

            function checkActionUser(link) {
                var htmlCode;
                if (link.link.show !== undefined) {
                    htmlCode = `<a style="background-color: #000080; color: white" href="${link.link.show}" class="m-1 col edit btn btn-sm"> {{ __('show')  }} </a>`;
                }
                if (link.link.edit !== undefined) {
                    htmlCode += `<a  href="${link.link.edit}" class="m-1 col edit btn btn-sm btn-secondary"> {{ __('edit')  }} </a>`;
                }
                if (link.link.destroy !== undefined) {
                    htmlCode += `<a  href="${link.link.destroy}"  class="m-1 col edit btn btn-sm btn-danger" onclick="return confirm('Вы уверены?')" >  {{ __('destroy')  }}  </a>`;
                }
                if (link.link.clone !== undefined) {
                    htmlCode += `<a  href="${link.link.clone}" class="m-1 col edit btn btn-sm btn-warning"> {{ __('clone')  }} </a>`;
                }
                return htmlCode;
            }
        </script>
    @endpush
@endsection
