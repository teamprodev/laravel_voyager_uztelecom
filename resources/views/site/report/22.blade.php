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
    <style>
        #example_filter{
            display: none;
        }
    </style>
</head>
{{ Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post() }}
<div style="text-align: end;margin-right: 100px">
    {{Aire::select([2021 => '2021', 2022 => '2022', 2023 => '2023',2024 => '2024'], 'select', 'Год')->value(Illuminate\Support\Facades\Cache::get('date_2'))->name('date_2')}}
    <button type="submit" class="btn btn-success">Менять</button>
</div>
{{ Aire::close() }}
@if(Illuminate\Support\Facades\Cache::get('date_2') != null)
    <table id="example" class="display nowrap">
        <thead>
        <tr style="text-align: center;">
            <td colspan="8" style="background-color: #2cb74c"><b style="margin-left: 720px";>1 kvartal</b>
            </td><td style="text-align: center; background-color: #2cb74c" colspan="6"><b>2 kvartal</b></td>
            <td style="text-align: center; background-color: #2cb74c" colspan="6"><b>3 kvartal</b></td>
            <td style="text-align: center; background-color: #2cb74c" colspan="6"><b>4 kvartal</b></td>
        </tr>
        <tr style="text-align: center;">
            <td colspan="4"><b style="margin-left: 700px;">товар</b></td>
            <td colspan="2"><b>работа</b></td>
            <td colspan="2"><b>услуга</b></td>
            <td colspan="2"><b>товар</b></td>
            <td colspan="2"><b>работа</b></td>
            <td colspan="2"><b>услуга</b></td>
            <td colspan="2"><b>товар</b></td>
            <td colspan="2"><b>работа</b></td>
            <td colspan="2"><b>услуга</b></td>
            <td colspan="2"><b>товар</b></td>
            <td colspan="2"><b>работа</b></td>
            <td colspan="2"><b>услуга</b></td>
        <tr>
            <th>ID</th>
            <th>Филиал</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>

            <th>С НДС</th>
            <th>Без НДС</th>
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
    <script>
        $(document).ready(function() {
            var buttonCommon = {
                extend: 'excel',
                title: '2-отчет квартальный плановый',
                text: '<i title="export to excel" class="fa fa-file-text-o">Excel</i><br>',
                exportOptions: {
                    columns: ':visible:Not(.not-exported)',
                    rows: ':visible',
                    format: {
                        header: function ( data, columnIdx ) {
                            if(columnIdx==2 || columnIdx==3 || columnIdx==8 || columnIdx==9 || columnIdx==14 || columnIdx==15 || columnIdx==20 || columnIdx==21){
                                return 'Товар ' + data;
                            }
                            if(columnIdx==4 || columnIdx==5 || columnIdx==10 || columnIdx==11 || columnIdx==16 || columnIdx==17 || columnIdx==22 || columnIdx==23){
                                return 'Работа ' + data;
                            }
                            if(columnIdx==6 || columnIdx==7 || columnIdx==12 || columnIdx==13 || columnIdx==18 || columnIdx==19 || columnIdx==24 || columnIdx==25){
                                return 'Услуга ' + data;
                            }
                            else{
                                return data;
                            }
                        }
                    }
                },
            };
            $('#example').DataTable( {
                // dom: 'PQlfrtip',
                dom: 'Qlfrtip' + 'Bfrtip',
                ajax:
                    "{{ route('report','22') }}",

                columns: [
                    {data: "id", name: 'id'},
                    {data: 'name', name: 'name'},

                    {data: 'tovar_1', name: 'tovar_1'},
                    {data: 'tovar_1_nds', name: 'tovar_1_nds'},

                    {data: 'rabota_1', name: 'rabota_1'},
                    {data: 'rabota_1_nds', name: 'rabota_1_nds'},

                    {data: 'usluga_1', name: 'usluga_1'},
                    {data: 'usluga_1_nds', name: 'usluga_1_nds'},


                    {data: 'tovar_2', name: 'tovar_2'},
                    {data: 'tovar_2_nds', name: 'tovar_2_nds'},

                    {data: 'rabota_2', name: 'rabota_2'},
                    {data: 'rabota_2_nds', name: 'rabota_2_nds'},

                    {data: 'usluga_2', name: 'usluga_2'},
                    {data: 'usluga_2_nds', name: 'usluga_2_nds'},


                    {data: 'tovar_3', name: 'tovar_3'},
                    {data: 'tovar_3_nds', name: 'tovar_3_nds'},

                    {data: 'rabota_3', name: 'rabota_3'},
                    {data: 'rabota_3_nds', name: 'rabota_3_nds'},

                    {data: 'usluga_3', name: 'usluga_3'},
                    {data: 'usluga_3_nds', name: 'usluga_3_nds'},


                    {data: 'tovar_4', name: 'tovar_4'},
                    {data: 'tovar_4_nds', name: 'tovar_4_nds'},

                    {data: 'rabota_4', name: 'rabota_4'},
                    {data: 'rabota_4_nds', name: 'rabota_4_nds'},

                    {data: 'usluga_4', name: 'usluga_4'},
                    {data: 'usluga_4_nds', name: 'usluga_4_nds'},

                ],
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } )
                ],
            });
        });
    </script>
@endif
<div class="pl-4 pt-4">
    <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
</div>
@endsection
