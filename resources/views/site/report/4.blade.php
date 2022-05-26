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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <style>
        #example_filter{
            display: none;
        }
    </style>
</head>
    <div id="section" class="pt-6">
        <div class="w-11/12 mx-auto pt-8 pb-16">
            <table id="example">
                <thead>
                <tr>
                    <th>№</th>
                    <th>Филиал</th>
                    <th>номер заявки</th>
                    <th>дата заявки</th>
                    <th>ФИО инициатора</th>
                    <th>Контактный телефон инициатора</th>
                    <th>отдел инициатора</th>
                    <th>вид закупки </th>
                    <th>Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                    <th>Предмет закупки (товар,работа,услуга)</th>
                    <th>кол-во закупаемого (товара,работа,услуги)</th>
                    <th>период</th>
                    <th>сумма заявки</th>
                    <th>С НДС?</th>
                    <th>{{__('lang.valyuta')}}</th>
                    <th>Наименование поставщика</th>
                    <th>сумма договора</th>
                    <th>Махсулот келишининг муддати</th>
                    <th>Статус</th>
                    <th>Начальник Исполнителя заявки</th>
                    <th>Исполнитель заявки</th>
                    <th>Бюджетни режалаштириш булими. Маълумот</th>
                    <th>Харидлар режасида мавжудлиги буича маълумот</th>
                    <th>{{ __('lang.table_18') }}</th>
                    <th>{{ __('lang.table_11') }}</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.2/js/dataTables.searchBuilder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.0.0/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            var buttonCommon = {
                extend: 'excel',
                title: '4 отчет заявки по статусам',
                text: '<i title="export to excel" class="fa fa-file-text-o">Excel</i><br>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible'
                },
            };
            $('#example').DataTable( {
                // dom: 'PQlfrtip',
                dom: 'Qlfrtip' + 'Bfrtip',

                ajax:
                    "{{ route('report','4') }}",

                columns: [
                    {data: "id", name: 'id'},
                    {data: 'branch_initiator_id', name: 'branch_initiator_id'},
                    {data: 'number', name: 'number'},
                    {data: 'date', name: 'date'},
                    {data: 'initiator', name: 'initiator'},
                    {data: 'initiator', name: 'initiator'},
                    {data: 'branch_initiator_id', name: 'branch_initiator_id'},
                    {data: 'type_of_purchase_id', name: 'type_of_purchase_id'},
                    {data: 'name', name: 'name'},
                    {data: 'subject', name: 'subject'},
                    {data: 'amount', name: 'amount'},
                    {data: 'expire_warranty_date', name: 'expire_warranty_date'},
                    {data: 'planned_price', name: 'planned_price'},
                    {data: 'with_nds', name: 'with_nds'},
                    {data: 'currency', name: 'currency'},
                    {data: 'supplier_name', name: 'supplier_name'},
                    {data: 'contract_price', name: 'contract_price'},
                    {data: 'delivery_date', name: 'delivery_date'},
                    {data: 'status', name: 'status'},
                    {data: 'id', name: 'id'},
                    {data: 'performer_user_id', name: 'performer_user_id'},
                    {data: 'info_business_plan', name: 'info_business_plan'},
                    {data: 'info_purchase_plan', name: 'info_purchase_plan'},
                    {data: 'purchase_basis', name: 'purchase_basis'},
                    {data: 'basis', name: 'basis'},
                ],
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } )
                ],
            });
        });
    </script>

<div class="pl-4 pt-4">
    <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
</div>
@endsection
