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
</head>

    <table id="example" class="display nowrap" border="1">
        <thead>
            <tr>
                <th style="text-align: center;"  rowspan="2">№</th>
                <th style="text-align: center;"  rowspan="2">Филиал</th>
                <th style="text-align: center;"  colspan="4">Информация о заявке</th>
                <th style="text-align: center;"  rowspan="2">Наименование товара</th>
                <th style="text-align: center;"  colspan="3">Договор</th>
                <th style="text-align: center;"  rowspan="2">Исполнитель</th>
            </tr>
            <tr>
                <th>Номер и дата заявки</th>
                <th>Планируеюмый буджет запуски (сум)</th>
                <th>Дата получения отделом</th>
                <th>Инициатор</th>
                <th>Номер договора</th>
                <th>Подставщик</th>
                <th>Сумма</th>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                // dom: 'PQlfrtip',
                dom: 'Qlfrtip',
                ajax:
                    "{{ route('report','8') }}",

                columns: [
                    {data: "id", name: 'id'},
                    {data: 'filial', name: 'filial'},

                    {
                        "data": "",
                        render: function (data, type, row) {
                            var details = `<b>${row.number}</b> ${row.date}` ;
                                return details;
                        }
                    },
                    {data: 'planned_price', name: 'planned_price'},
                    {data: 'performer_received_date', name: 'performer_received_date'},
                    {data: 'initiator', name: 'initiator'},
                    {data: 'product', name: 'product'},
                    {data: 'contract_number', name: 'contract_number'},
                    {data: 'supplier_name', name: 'supplier_name'},
                    {data: 'contract_price', name: 'contract_price'},
                    {data: 'performer_user_id', name: 'performer_user_id'},
                ]
            });
        });
    </script>
<div class="pl-4 pt-4">
    <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
</div>
