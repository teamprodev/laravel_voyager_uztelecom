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
{{ Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post() }}
<div style="text-align: center; display: flex; justify-content: end; align-items: center; column-gap: 10px; margin-right: 20px">
    {{Aire::month('m', __('Месяц'))->value(Illuminate\Support\Facades\Cache::get('date_5'))->name('date_5')}}

    <button type="submit" class="btn btn-success" style="margin-top: 8px;">{{__('Выбрать')}}</button>
</div>
{{ Aire::close() }}
@if(Illuminate\Support\Facades\Cache::get('date_5') != null)
    <table id="example" class="display wrap table-bordered dt-responsive" style="border-collapse: collapse; width: 100%; padding-top: 10px">
        <thead class="border border-dark">

            <tr class="border border-dark">
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('ID') }}</th>
                <th style="text-align: center;" class="border border-dark" rowspan="2">{{ __('Филиал') }}</th>
                <th style="text-align: center;" class="border border-dark" colspan="2">{{ __('Заключенные договора') }}</th>
                <th style="text-align: center;" class="border border-dark" colspan="2"><b>{{ __('товар')}}</b></th>
                <th style="text-align: center;" class="border border-dark" colspan="2"><b>{{ __('работа') }}</b></th>
                <th style="text-align: center;" class="border border-dark" colspan="2"><b>{{ __('услуга') }}</b></th>
            </tr>
            <tr class="border border-dark">
                <th style="text-align: center;" class="border border-dark">{{ __('кол-во') }}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('сумма') }}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('кол-во') }}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('сумма')}}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('кол-во') }}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('сумма') }}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('кол-во') }}</th>
                <th style="text-align: center;" class="border border-dark">{{ __('сумма') }}</th>
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
        function export_format(data, columnIdx){
            switch (columnIdx) {
                case 2:
                case 3:
                    return '__('Заключенные договора') ' + data;
                case 4:
                case 5:
                    return '__('Товар') ' + data;
                case 6:
                case 7:
                    return '__('Работа') ' + data;
                case 8:
                case 9:
                    return '__('Услуга') ' + data;
                default:
                    return data;
            }
        }
        var columns = [
            {data: "id", name: 'id'},
            {data: 'name', name: 'name'},

            {data: 'count', name: 'count'},
            {data: 'summa', name: 'summa'},
            {data: 'count_1', name: 'count_1'},
            {data: 'summa_1', name: 'summa_1'},
            {data: 'count_2', name: 'count_2'},
            {data: 'summa_2', name: 'summa_2'},
            {data: 'count_3', name: 'count_3'},
            {data: 'summa_3', name: 'summa_3'},
        ];
        var getData = "{{ route('report','5') }}";
        var tableTitle = "{{ __('5 - Отчет свод  общий') }}";
    </script>
@endif
@include('site.components.yajra')
@endsection
