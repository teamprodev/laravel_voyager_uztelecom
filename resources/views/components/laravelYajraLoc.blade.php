<div id="fortext"></div>

<table id="{{$tableId}}" class="display wrap table-bordered " style="border-collapse: collapse; width: 100%; padding-top: 10px">
    <thead class="border border-dark">

    <tr class="border border-dark">
        @foreach($dtHeaders as $header => $key)
        <th colspan="{{$key["colspan"]}}" rowspan="{{$key["rowspan"]}}" style="text-align: center;" class="border border-dark">{{ $header }}</th>
        @endforeach
    </tr>
    @if($dtTitles != null)
        <tr class="border border-dark">
            @foreach($dtTitles as $title)
            <th style="text-align: center;" class="border border-dark">{{ $title }}</th>
            @endforeach
        </tr>
    @endif
    </thead>
</table>
<script>
    $(document).ready(function() {
        $.fn.dataTable.moment('DD-MM-YYYY');

        $('#{{$tableId}}').DataTable( {
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
            columns: {!! str_replace("&#039;", "'", $dtColumns); !!},
            ajax: "{{$getData}}",
            stateSave: "{{$stateSave}}",
            {!! $buttons !!}
            scrollX: "{{$scrollX}}",
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
