@extends('site.layouts.app')
@section('center_content')
    @if(auth()->user()->branch_id != null && auth()->user()->department_id != null)
        <head>
            <style>
                .dt-buttons {
                    width: 100%;
                }

                .dt-body-center, .dt-body-right {
                    font-size: 0.8rem;
                }

                .btn {
                    font-size: 0.85rem !important;
                    padding: 2px !important;
                }

                .btn-sm {
                    font-size: 0.75rem !important;
                    padding: 3px !important;
                }

                thead > tr > th.sorting, table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting_asc_disabled, table.dataTable thead > tr > th.sorting_desc_disabled, table.dataTable thead > tr > td.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting_asc_disabled, table.dataTable thead > tr > td.sorting_desc_disabled {
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
                <table id="yajra-datatable" class="display wrap responsive" style="width: 100%">
                    <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>{{ __('Статус заявки') }}</th>
                        <th>{{__('Визирование заявки через:') }}</th>
                        <th>{{ __('Номер Заявки')}}</th>
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
    @else
        @if(auth()->user()->department_id == null)
            <h1 style="color: red; text-align:center;">Вы не выбрали ваш Отдел<br>Админ должен перенаправить вас в отдел
            </h1>
        @elseif(auth()->user()->branch_id == null)
            <h1 style="color: red; text-align:center;">Вы не выбрали ваш Филиал<br>Админ должен перенаправить вас в
                филиал</h1>
        @endif
    @endif
    @push('scripts')
        <script>
            $(function () {
                var table = $('#yajra-datatable').DataTable({
                    responsive: true,
                    columnDefs: [
                        {
                            targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12],
                            className: 'dt-body-center dt-head-center'
                        },
                        {
                            targets: 12,
                            className: 'not-exported'
                        },
                        {
                            targets: 9,
                            className: 'dt-body-right dt-head-center'
                        },
                    ],
                    order: [[0, "desc"]],
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "{{ __('Все') }}"]],
                    "language": {
                        "lengthMenu": "Показать _MENU_ записей",
                        "info": 'Показаны записи в диапазоне от _START_ до _END_ (В общем _TOTAL_)',
                        "search": "{{ __('Поиск') }}",
                        "paginate": {
                            "previous": "Назад",
                            "next": "Дальше"
                        }
                    }, processing: false,
                    serverSide: true,
                    buttons: {
                        buttons: [
                            {
                                extend: 'copyHtml5',
                                text: '<i class="fas fa-copy"></i>',
                                title: "Заявки",
                                titleAttr: 'Скопировать в буфер обмена',
                                exportOptions: {
                                    columns: ':Not(.not-exported)',
                                    rows: ':visible',
                                },
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fas fa-file-excel"></i>',
                                title: "Заявки",
                                titleAttr: 'Экспорт в Excel',
                                exportOptions: {
                                    columns: ':Not(.not-exported)',
                                    rows: ':visible',
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fas fa-file-pdf"></i>',
                                title: "Заявки",
                                titleAttr: 'Экспорт в PDF',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: ':Not(.not-exported)',
                                    rows: ':visible',
                                },
                            },
                            {
                                extend: 'print',
                                text: '<i class="fas fa-print"></i>',
                                title: "Заявки",
                                titleAttr: 'Распечатать',
                                exportOptions: {
                                    columns: ':Not(.not-exported)',
                                    rows: ':visible',
                                },
                                customize: function (win) {

                                    var last = null;
                                    var current = null;
                                    var bod = [];

                                    var css = '@page { size: landscape; }',
                                        head = win.document.head || win.document.getElementsByTagName('head')[0],
                                        style = win.document.createElement('style');

                                    style.type = 'text/css';
                                    style.media = 'print';

                                    if (style.styleSheet) {
                                        style.styleSheet.cssText = css;
                                    } else {
                                        style.appendChild(win.document.createTextNode(css));
                                    }

                                    head.appendChild(style);
                                }
                            },
                            {
                                extend: 'colvis',
                                text: '<i class="fas fa-eye"></i>',
                                titleAttr: 'Показать/скрыть колонки',
                                exportOptions: {
                                    columns: ':Not(.not-exported)',
                                    rows: ':visible',
                                },
                            }
                        ],
                        dom: {
                            button: {
                                className: 'dt-button'
                            }
                        }
                    },
                    dom: "Blfrtip",
                    ajax:
                        "{{ route('site.applications.index_getData') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {
                            "data": "status",
                            render: function (data, type, row) {
                                var details = JSON.parse(row.status).backgroundColor;
                                var color = JSON.parse(row.status).color;
                                var app = JSON.parse(row.status).app;
                                return `<button style='background-color: ${details};color:${color};' class='btn btn-sm'>` + app + `</button>`;
                            }
                        },
                        {data: 'is_more_than_limit', name: 'is_more_than_limit'},
                        {data: 'number', name: 'number'},
                        {data: 'date', name: 'date'},
                        {data: 'initiator', name: 'initiator'},
                        {data: 'branch_initiator_id', name: 'branch_initiator_id'},
                        {data: 'name', name: 'name'},
                        {data: 'delivery_date', name: 'delivery_date'},
                        {
                            data: 'planned_price_curr', name: 'planned_price_curr', render: function (data, type, row) {
                                if (row.planned_price === null || row.planned_price==="" ) return " "
                                return new Intl.NumberFormat('ru-RU').format(row.planned_price) + ' ' + row.currency;
                            }
                        },
                        {data: 'incoterms', name: 'incoterms'},
                        {data: 'created_at', name: 'created_at'},
                        {
                            data: 'action',
                            render: function (link) {
                                return checkActionUser(JSON.parse(link));
                            },
                            name: 'action',
                        },
                    ]
                });
            });

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
