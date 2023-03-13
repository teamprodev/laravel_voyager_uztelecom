<div id="fortext"></div>
<x-laravelDateRangePicker reportId="2"  route="{{ route('site.report.index','2') }}" format="YYYY"/>

<table id="example" class="display wrap table-bordered " style="border-collapse: collapse; width: 100%; padding-top: 10px">
    <thead class="border border-dark">

    <tr class="border border-dark">
        @foreach($dtHeaders as $header => $key)
        <th colspan="{{$key["colspan"]}}" rowspan="{{$key["rowspan"]}}" style="text-align: center;" class="border border-dark">{{ $header }}</th>
        @endforeach
    </tr>

    <tr class="border border-dark">
        @foreach($dtTitles as $title)
        <th style="text-align: center;" class="border border-dark">{{ $title }}</th>
        @endforeach
    </tr>
    </thead>
</table>

<script>
    var columns = [
        {data: "id", name: 'id'},
        {data: 'name', name: 'name'},

        {data: 'tovar_1', name: 'tovar_1'},
        {data: 'rabota_1', name: 'rabota_1'},
        {data: 'usluga_1', name: 'usluga_1'},

        {data: 'tovar_2', name: 'tovar_2'},
        {data: 'rabota_2', name: 'rabota_2'},
        {data: 'usluga_2', name: 'usluga_2'},

        {data: 'tovar_3', name: 'tovar_3'},
        {data: 'rabota_3', name: 'rabota_3'},
        {data: 'usluga_3', name: 'usluga_3'},

        {data: 'tovar_4', name: 'tovar_4'},
        {data: 'rabota_4', name: 'rabota_4'},
        {data: 'usluga_4', name: 'usluga_4'},
    ];
</script>
<script>
    $(document).ready(function() {
        $.fn.dataTable.moment('DD-MM-YYYY');

        $('#example').DataTable( {
            keys: {{$keys}},
            rowReorder: {{$rowReorder}},
            rowGroup: {{$rowGroup}},
            responsive: {{$responsive}},
            select: {{$select}},
            order: [[0, 'desc']],
            colReorder: {{$colReorder}},
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "{{ __('Все') }}"] ] ,
            "pagingType": "{{$pagingType}}",
            pageLength: {{$pageLength}},
            "language" : {!! $language !!},
            dom: "{{$dom}}",
            ajax: "{{$getData}}",
            {!! $buttons !!}
            columns: columns,
            {{--buttons: {--}}
            {{--    buttons: [--}}
            {{--        { extend: 'copyHtml5',--}}
            {{--            text: '<i class="fas fa-copy"></i>',--}}
            {{--            title: '{{$tableTitle}}',--}}
            {{--            titleAttr: 'Скопировать в буфер обмена',--}}
            {{--            exportOptions: {--}}
            {{--                columns: ':visible:Not(.not-exported)',--}}
            {{--                rows: ':visible',--}}
            {{--                format:{--}}
            {{--                    header: function ( data, columnIdx ) {--}}
            {{--                        if(typeof export_format === "function")--}}
            {{--                            return export_format(data, columnIdx);--}}
            {{--                        return data;--}}
            {{--                    }--}}
            {{--                }--}}
            {{--            },--}}
            {{--        },--}}
            {{--            @if($getData == route('report', '4') || $getData == route('report', '6') || $getData == route('report', '7') || $getData == route('report', '8'))--}}
            {{--        {--}}
            {{--            text: 'Export',--}}
            {{--            action: function ( e, dt, node, config ) {--}}
            {{--                window.location.href = "{{$exportId}}";--}}
            {{--            }--}}
            {{--        },--}}
            {{--            @endif--}}
            {{--        { extend: 'excelHtml5',--}}
            {{--            text: '<i class="fas fa-file-excel"></i>',--}}
            {{--            title: '{{$tableTitle}}',--}}
            {{--            titleAttr: 'Экспорт в Excel',--}}
            {{--            exportOptions: {--}}
            {{--                columns: ':visible:Not(.not-exported)',--}}
            {{--                rows: ':visible',--}}
            {{--                format:{--}}
            {{--                    header: function ( data, columnIdx ) {--}}
            {{--                        if(typeof export_format === "function")--}}
            {{--                            return export_format(data, columnIdx);--}}
            {{--                        return data;--}}
            {{--                    }--}}
            {{--                }--}}
            {{--            },--}}
            {{--        },--}}

            {{--        { extend: 'pdfHtml5',--}}
            {{--            text: '<i class="fas fa-file-pdf"></i>',--}}
            {{--            title: '{{$tableTitle}}',--}}
            {{--            titleAttr: 'Экспорт в PDF',--}}
            {{--            orientation: 'landscape',--}}
            {{--            pageSize: 'LEGAL',--}}
            {{--            exportOptions: {--}}
            {{--                columns: ':visible:Not(.not-exported)',--}}
            {{--                rows: ':visible',--}}
            {{--                format:{--}}
            {{--                    header: function ( data, columnIdx ) {--}}
            {{--                        if(typeof export_format === "function")--}}
            {{--                            return export_format(data, columnIdx);--}}
            {{--                        return data;--}}
            {{--                    }--}}
            {{--                }--}}
            {{--            },--}}
            {{--        },--}}
            {{--        { extend: 'print',--}}
            {{--            text: '<i class="fas fa-print"></i>',--}}
            {{--            title: '{{$tableTitle}}',--}}
            {{--            titleAttr: 'Распечатать',--}}
            {{--            exportOptions: {--}}
            {{--                columns: ':visible:Not(.not-exported)',--}}
            {{--                rows: ':visible',--}}
            {{--                format:{--}}
            {{--                    header: function ( data, columnIdx ) {--}}
            {{--                        if(typeof export_format === "function")--}}
            {{--                            return export_format(data, columnIdx);--}}
            {{--                        return data;--}}
            {{--                    }--}}
            {{--                }--}}
            {{--            },--}}
            {{--        },--}}
            {{--        { extend: 'colvis',--}}
            {{--            text: '<i class="fas fa-eye"></i>',--}}
            {{--            titleAttr: 'Показать/скрыть колонки',--}}
            {{--            exportOptions: {--}}
            {{--                columns: ':visible:Not(.not-exported)',--}}
            {{--                rows: ':visible',--}}
            {{--            },--}}
            {{--        }--}}
            {{--    ],--}}
            {{--    dom: {--}}
            {{--        button: {--}}
            {{--            className: 'dt-button'--}}
            {{--        }--}}
            {{--    }--}}
            {{--},--}}
            "fnInitComplete": function(){

                // Enable THEAD scroll bars
                $('.dataTables_scrollHead').css('overflow', 'auto');

                // Sync THEAD scrolling with TBODY
                $('.dataTables_scrollHead').on('scroll', function () {
                    $('.dataTables_scrollBody').scrollLeft($(this).scrollLeft());
                });
            },
        });
        var divTitle = ''
            + '<div class="col-12 text-center text-md-left pt-4 pb-4 display-2" style="text-align: center !important;">'
            + '<h1 class="text-dark">' + '{{$tableTitle}}' + '</h1>'
            + '</div>';

        $("#fortext").append(divTitle);

        $(".content").prepend('<div id = "buttons-container" class="buttons-container"></div>');

        $("#buttons-container").append($(".dataTables_length"));
        $("#buttons-container").append($(".daterangepicker-form"));
        $("#buttons-container").append($(".dt-buttons"));
        $("#buttons-container").append($(".dataTables_filter"));
        $("#buttons-container").insertAfter($("#fortext"));



    });
</script>
