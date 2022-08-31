@extends('site.layouts.app')
@section('center_content')
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"/>

    <link href="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.0/css/searchPanes.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.3/css/searchBuilder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/date-1.0.3/r-2.2.7/sb-1.0.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
</head>

    <div id="fortext"></div>

    <table id="example" class="display wrap table-bordered " style="border-collapse: collapse; width: 100%; padding-top: 10px">
        <thead class="border border-dark">
            <tr class="border border-dark">
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{__('ID')  }}</th>
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('Филиал') }}</th>
                <th style="text-align: center;" class="border border-dark" colspan="4">{{ __('Информация о заявке') }}</th>
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('Наименование товара') }}</th>
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('Вид закупки') }}</th>
                <th style="text-align: center;" class="border border-dark" colspan="3">{{ __('Договор') }}</th>
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('Исполнитель') }}</th>
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('Дата Создания') }}</th>
            </tr>
            <tr>
                <th class="border border-dark">{{ __('Номер и дата заявки') }}</th>
                <th class="border border-dark">{{ __('Планируемый бюджет закупки (сум)') }}</th>
                <th class="border border-dark">{{ __('Дата получения отделом') }}</th>
                <th class="border border-dark">{{ __('Инициатор')}}</th>
                <th class="border border-dark">{{ __('Номер договора') }}</th>
                <th class="border border-dark">{{ __('Поставщик') }}</th>
                <th class="border border-dark">{{ __('Сумма')  }}</th>
            </tr>
        </thead>
    </table>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.2/js/dataTables.searchBuilder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.0.0/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.4.1/js/all.js" integrity="sha384-L469/ELG4Bg9sDQbl0hvjMq8pOcqFgkSpwhwnslzvVVGpDjYJ6wJJyYjvG3u8XW7" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.2/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>


<script>
    var columns = [
        {data: "id", name: 'id'},
        {data: 'filial', name: 'filial'},
        {data: 'number_and_date_of_app', name: 'number_and_date_of_app'},
        {data: 'planned_price', name: 'planned_price'},
        {data: 'performer_received_date', name: 'performer_received_date'},
        {data: 'initiator', name: 'initiator'},
        {data: 'product', name: 'product'},
        {data: 'type_of_purchase', name: 'type_of_purchase'},
        {data: 'contract_number', name: 'contract_number'},
        {data: 'supplier_name', name: 'supplier_name'},
        {data: 'contract_price', name: 'contract_price'},
        {data: 'performer_user_id', name: 'performer_user_id'},
        {data: 'created_at', name: 'created_at'},
    ];
    var getData = "{{ route('report','8') }}";
    var tableTitle = "{{__('8 - Отчет по видам закупки')}}";

</script>
@include('site.components.yajra')
@endsection
