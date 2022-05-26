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
                    <th>"Контрагент (предприятия поставляющий товаров. работ. услуг)"</th>
                    <th>Договор (контракт)</th>
                    <th>Предмет закупки (товар,работа,услуга)</th>
                    <th>номер заявки</th>
                    <th>сумма заявки</th>
                    <th>Предмет договора (контракта) и краткая характеристика</th>
                    <th>Общая сумма договора (контракта)</th>
                    <!-- <th>Протокол внутренней комиссии</th> -->
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
            title: '6 отчет свод',
            text: '<i title="export to excel" class="fa fa-file-text-o">Excel</i><br>',
            exportOptions: {
                columns: ':visible:Not(.not-exported)',
                rows: ':visible'
            },
        };


        $('#example').DataTable( {
             // dom: 'PQlfrtip',
            dom: 'PQlfrtip' + 'Bfrtip',
            ajax:
                 "{{ route('report','6') }}",

            columns: [
                        {data: "id", name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'supplier_name', name: 'supplier_name'},
                        {data: 'contract_number', name: 'contract_number    '},
                        {data: 'subject', name: 'subject'},
                        {data: 'number', name: 'number'},
                        {data: 'planned_price', name: 'planned_price'},
                        {data: 'contract_info', name: 'contract_info'},
                        {data: 'contract_price', name: 'contract_price'},
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
