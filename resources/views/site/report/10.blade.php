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
{{ Aire::open()
  ->route('request')
  ->enctype("multipart/form-data")
  ->post() }}
<div style="text-align: end;margin-right: 100px">
    {{Aire::select([2021 => '2021', 2022 => '2022', 2023 => '2023',2024 => '2024'], 'select', 'Год')->value(Illuminate\Support\Facades\Cache::get('date_10'))->name('date_10')}}
    <button type="submit" class="btn btn-success">Менять</button>
</div>
{{ Aire::close() }}
@if(Illuminate\Support\Facades\Cache::get('date_10') != null)
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Год</th>
        <th>январь</th>
        <th>февраль</th>
        <th>март</th>
        <th>апрель</th>
        <th>май</th>
        <th>июнь</th>
        <th>июль</th>
        <th>август</th>
        <th>сентябрь</th>
        <th>октябрь</th>
        <th>ноябрь</th>
        <th>декабрь</th>
        <th>Итого</th>
    </tr>
    </thead>
</table>
@endif
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
                "{{ route('report','10') }}",

            columns: [
                {data: 'name', name: 'name'},
                {data: 'january', name: 'january'},
                {data: 'february', name: 'february'},
                {data: 'march', name: 'march'},
                {data: 'april', name: 'april'},
                {data: 'may', name: 'may'},
                {data: 'june', name: 'june'},
                {data: 'july', name: 'july'},
                {data: 'august', name: 'august'},
                {data: 'september', name: 'september'},
                {data: 'october', name: 'october'},
                {data: 'november', name: 'november'},
                {data: 'december', name: 'december'},
                {data: 'all', name: 'all'},
            ]
        });
    });
</script>
<div class="pl-4 pt-4">
    <a href="/" class="btn btn-danger">{{ __('lang.back') }}</a>
</div>
