
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
</head>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>№</th>
        <th>Молиялаштириш манбаи</th>
        <th>Етказиб берувчининг номи</th>
        <th>Етказиб берувчининг СТИРи</th>
        <th>Шартнома рақами </th>
        <th>Шартнома тузилган сана</th>
        <th>Шартнома суммаси</th>
        <th>Валюта</th>
        <th>Давлат харидлари бўйича махсус ахборот порталига жойлаштирилган ЛОТ рақами ва санаси</th>
        <th>Харид тури</th>
        <th>Шартнома предмети</th>
        <th>Товар (хизмат) ишлаб чиқарилган мамлакат</th>
        <th>Асос: “Давлат харидлари тўғрисида”ги Қонун/ бошқа қарорлар</th>
    </tr>
    </thead>
</table>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchbuilder/1.3.2/js/dataTables.searchBuilder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/searchpanes/2.0.0/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            // dom: 'PQlfrtip',
            dom: 'Qlfrtip',
            ajax:
                "{{ route('report','7') }}",

            columns: [
                {data: "id", name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'supplier_name', name: 'supplier_name'},
                {data: 'supplier_inn', name: 'supplier_inn'},
                {data: 'contract_number', name: 'contract_number'},
                {data: 'contract_date', name: 'contract_date'},
                {data: 'contract_price', name: 'contract_price'},
                {data: 'currency', name: 'currency'},
                {data: 'lot_number', name: 'lot_number'},
                {data: 'type_of_purchase_id', name: 'type_of_purchase_id'},
                {data: 'contract_info', name: 'contract_info'},
                {data: 'country_produced_id', name: 'country_produced_id'},
                {data: 'purchase_basis', name: 'purchase_basis'},
            ]
        });
    });
</script>
<div class="pl-4 pt-4">
    <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
</div>


