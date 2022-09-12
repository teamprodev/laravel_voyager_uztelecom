@extends('site.layouts.app')
@section('center_content')
    <!doctype html>
<html lang="en">
<head>
    <link href="https://releases.transloadit.com/uppy/v2.4.1/uppy.min.css" rel="stylesheet">
    <!--Regular Datatables CSS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchbuilder/1.3.2/css/searchBuilder.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.0.0/css/searchPanes.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>

</head>
<div id="fortext"></div>
<table id="example" class="display wrap table-bordered " style="border-collapse: collapse; width: 100%; padding-top: 10px">
    <thead class="border border-dark">
    <tr class="border border-dark">
        <th style="text-align: center;" class="border border-dark">{{ __('ID') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Филиал')  }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('номер заявки') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('дата заявки')}}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('ФИО инициатора') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Контактный телефон инициатора') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('отдел инициатора') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('вид закупки')}}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Предмет закупки (товар,работа,услуга)')}}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('период') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('сумма заявки') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('С НДС')}}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Валюта') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Наименование поставщика') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('сумма договора') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Махсулот келишининг муддати') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Статус') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Начальник Исполнителя заявки') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Исполнитель заявки') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Бюджетни режалаштириш булими. Маълумот') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Харидлар режасида мавжудлиги буича маълумот') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Предмет закупки') }}</th>
        <th style="text-align: center;" class="border border-dark">{{ __('Основание(план закупок, рапорт, расспорежение руководства)') }}</th>
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
        {data: 'id', name: 'id'},
        {data: 'branch_initiator_id', name: 'branch_initiator_id'},
        {data: 'number', name: 'number'},
        {data: 'date', name: 'date'},
        {data: 'user_id', name: 'user_id'},
        {data: 'phone', name: 'phone'},
        {data: 'department_initiator_id', name: 'department_initiator_id'},
        {data: 'type_of_purchase_id', name: 'type_of_purchase_id'},
        {data: 'resource_id', name: 'resource_id'},
        {data: 'subject', name: 'subject'},
        {data: 'expire_warranty_date', name: 'expire_warranty_date'},
        {data: 'planned_price', name: 'planned_price'},
        {data: 'with_nds', name: 'with_nds'},
        {data: 'currency', name: 'currency'},
        {data: 'supplier_name', name: 'supplier_name'},
        {data: 'contract_price', name: 'contract_price'},
        {data: 'delivery_date', name: 'delivery_date'},
        {data: 'status', name: 'status'},
        {data: 'performer_leader_user_id', name: 'performer_leader_user_id'},
        {data: 'performer_user_id', name: 'performer_user_id'},
        {data: 'info_business_plan', name: 'info_business_plan'},
        {data: 'info_purchase_plan', name: 'info_purchase_plan'},
        {data: 'purchase_basis', name: 'purchase_basis'},
        {data: 'basis', name: 'basis'},
    ];
</script>
<x-laravelYajra getData="{{ route('report','4') }}" tableTitle="{{ __('4 - Отчет заявки по статусам') }}"/>

@endsection
