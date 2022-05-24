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
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th rowspan="2">№</th>
        <th rowspan="2">Буюртмачи номи</th>
        <th rowspan="2">СТИР</th>
        <th colspan="2" style="text-align: center">Шартномалар</th>
        <th colspan="2" style="text-align: center">Электрон дўкон орқали (E-shop))</th>
        <th colspan="2" style="text-align: center">Миллий дўкон орқали</th>
        <th colspan="2" style="text-align: center">Электрон аукцион орқали</th>
        <th colspan="2" style="text-align: center">Кооперация портали орқали</th>
        <th colspan="2" style="text-align: center">Шаффоф қурилиш платформаси орқали</th>
        <th colspan="2" style="text-align: center">Махсус савдо майдончаларидаги электрон биржа савдолари орқали</th>
        <th colspan="2" style="text-align: center">конкурс (танлов орқали)</th>
        <th colspan="2" style="text-align: center">Тендер орқали</th>
        <th colspan="2" style="text-align: center">Энг мақбул таклифларни танлаб олиш йули билан</th>
        <th colspan="2" style="text-align: center">Ягона етказиб берувчилар билан </th>
        <th colspan="2" style="text-align: center">Тўғридан-тўғри (ПП-3988, ва бошқалар ПП,УП,РП)</th>
    </tr>
    <tr>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
        <th>Сони</th>
        <th>Суммаси</th>
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
            title: '9-ойлик харидлар илова плановый',
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
                "{{ route('report','9') }}",

            columns: [
                {data: "id", name: 'id'},
                {data: "name", name: 'name'},
                {data: "supplier_inn", name: 'supplier_inn'},

                {data: "contract_count", name: 'contract_count'},
                {data: "contract_sum", name: 'contract_sum'},

                {data: "eshop_count", name: 'eshop_count'},
                {data: "eshop_sum", name: 'eshop_sum'},

                {data: "nat_eshop_count", name: 'nat_eshop_count'},
                {data: "nat_eshop_sum", name: 'nat_eshop_sum'},

                {data: "auction_count", name: 'auction_count'},
                {data: "auction_sum", name: 'auction_sum'},

                {data: "coop_portal_count", name: 'coop_portal_count'},
                {data: "coop_portal_sum", name: 'coop_portal_sum'},

                {data: "tender_platform_count", name: 'tender_platform_count'},
                {data: "tender_platform_sum", name: 'tender_platform_sum'},

                {data: "exchange_count", name: 'exchange_count'},
                {data: "exchange_sum", name: 'exchange_sum'},

                {data: "konkurs_count", name: 'konkurs_count'},
                {data: "konkurs_sum", name: 'konkurs_sum'},

                {data: "tender_count", name: 'tender_count'},
                {data: "tender_sum", name: 'tender_sum'},

                {data: "otbor_count", name: 'otbor_count'},
                {data: "otbor_sum", name: 'otbor_sum'},

                {data: "sole_supplier_count", name: 'sole_supplier_count'},
                {data: "sole_supplier_sum", name: 'sole_supplier_sum'},

                {data: "direct_count", name: 'direct_count'},
                {data: "direct_sum", name: 'direct_sum'},
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


