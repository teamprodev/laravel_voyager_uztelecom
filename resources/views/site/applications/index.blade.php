@extends('site.layouts.wrapper')
@section('center_content')



    <div class="card mt-4 mx-4 p-4">
        <div>
            <div class="col-lg-12">
                <a class="btn btn-primary mb-4" href="{{route('site.applications.create')}}">
                    Создать новую заявку
                </a>
            </div>
        </div>
        <div class="card-header">
            Заявки
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover datatable datatable-TransactionType">
                <thead>
                <tr>
                    <th data-priority="1">Id</th>
                    <th data-priority="1">Ташаббускор (буюртмачи номи )</th>
                    <th data-priority="2">Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                    <th data-priority="3">Махсулот келишининг муддати</th>
                    <th data-priority="4">Харид режаси (сумма)</th>
{{--                    <th data-priority="5">Валюта</th>--}}
{{--                    <th data-priority="6">Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)</th>--}}
{{--                    <th data-priority="7">Изох</th>--}}
                    <th data-priority="16">Дата создания</th>
                    <th data-priority="16">Изменения</th>
                </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->specification }}</td>
{{--                        <td>{{ $application->description }}</td>--}}
                        <td>{{ $application->delivery_date }}</td>
                        <td>{{ $application->amount }} {{ $application->currency }}</td>
{{--                        <td>{{ $application->id }}</td>--}}
                        <td>{{ $application->created_at }}</td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="">
                                btn
                            </a>

                            <a class="btn btn-xs btn-info" href="">
                                btnm
                            </a>

                            <form action="" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="btn2">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "",
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

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 10,
                "columnDefs": [
                    { "visible": false, "targets": 0 },
                    { "visible": false, "targets": 1 },
                ]
            });
            $('.datatable-TransactionType:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
@endsection
