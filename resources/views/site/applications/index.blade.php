@extends('site.layouts.app')
@section('center_content')
@if(auth()->user()->branch_id != null && auth()->user()->department_id != null)
    <head>
        <style>
            .dt-buttons{
                width: 100%;
            }

        </style>
    </head>
<div id="section" class="pt-6">
    <a href="{{route('site.applications.create')}}"
        class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
        {{ __('Создать') }}
    </a>
    <div class="w-11/12 mx-auto pt-8 pb-16">
        <table id="yajra-datatable" class="display wrap">
            <thead  class="text-center">
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
@else
    @if(auth()->user()->department_id == null)
        <h1 style="color: red; text-align:center;">Вы не выбрали ваш Отдел<br>Админ должен перенаправить вас в отдел</h1>
    @elseif(auth()->user()->branch_id == null)
        <h1 style="color: red; text-align:center;">Вы не выбрали ваш Филиал<br>Админ должен перенаправить вас в филиал</h1>
    @endif
@endif
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
                        targets: 12,
                        className: 'not-exported'
                    },
                    {
                        targets: 7,
                        className: 'dt-body-right dt-head-center'}
                ],
                order: [[ 0, "desc" ]],
                "language": {
                    "lengthMenu": "Показать _MENU_ записей",
                    "info":      'Показаны записи в диапазоне от _START_ до _END_ (В общем _TOTAL_)',
                    "search":  "{{ __('Поиск') }}",
                    "paginate": {
                        "previous": "Назад",
                        "next": "Дальше"
                    }
                }, processing: false,
                serverSide: true,
                buttons: {
                    buttons: [
                        { extend: 'copyHtml5',
                            text: '<i class="fas fa-copy"></i>',
                            title: "Заявки",
                            titleAttr: 'Скопировать в буфер обмена',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible',
                            },
                        },
                        { extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            title: "Заявки",
                            titleAttr: 'Экспорт в Excel',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible',
                            },
                        },
                        { extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            title: "Заявки",
                            titleAttr: 'Экспорт в PDF',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible',
                            },
                        },
                        { extend: 'print',
                            text: '<i class="fas fa-print"></i>',
                            title: "Заявки",
                            titleAttr: 'Распечатать',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
                                rows: ':visible',
                            },
                            customize: function(win)
                            {

                                var last = null;
                                var current = null;
                                var bod = [];

                                var css = '@page { size: landscape; }',
                                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                                    style = win.document.createElement('style');

                                style.type = 'text/css';
                                style.media = 'print';

                                if (style.styleSheet)
                                {
                                    style.styleSheet.cssText = css;
                                }
                                else
                                {
                                    style.appendChild(win.document.createTextNode(css));
                                }

                                head.appendChild(style);
                            }
                        },
                        { extend: 'colvis',
                            text: '<i class="fas fa-eye"></i>',
                            titleAttr: 'Показать/скрыть колонки',
                            exportOptions: {
                                columns: ':visible:Not(.not-exported)',
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
                    "{{ route('site.applications.index') }}",
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
    </script>
@endpush
@endsection
