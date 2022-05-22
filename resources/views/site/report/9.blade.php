

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
</head>

    <div id="section" class="pt-6">
        <a href="/" class="ml-12 btn btn-danger">{{ __('lang.back') }}</a>
        <div class="w-11/12 mx-auto pt-8 pb-16">
            <table id="yajra-datatable" class="table table-bordered" border="5">
                <thead>
                     <tr>
                        <th style="text-align: center;"  rowspan="3">№</th>
                        <th style="text-align: center;"  rowspan="17">Имя Клиента</th>
                        <th style="text-align: center;"  rowspan="18">STIR</th>
                        <th style="text-align: center;"  colspan="2">Соглашения</th>
                        <th style="text-align: center;"  colspan="24">Затем:</th>
                     </tr>
                     
                     <tr>
                        <th rowspan="2">количество</th>
                        <th rowspan="2">количество (сум)</th> 
                        <th rowspan="1" colspan="2">тендер</th> 
                        <th rowspan="1" colspan="2">отбор</th>
                        <th rowspan="1" colspan="2">Eshop</th>  
                        <th rowspan="1" colspan="2">электронный аукцион</th>  
                        <th rowspan="1" colspan="2">кооперационный портал</th>  
                        <th rowspan="1" colspan="2">конкурс</th>  
                        <th rowspan="1" colspan="2">национальный электронный магазин</th>  
                        <th rowspan="1" colspan="2">электронный магазин(E-Shop)</th>  
                        <th rowspan="1" colspan="2">через элетронную тендерную платформу проведения госзакупок в сфере строительства</th> 
                        <th rowspan="1" colspan="2">через электронные биржевые торги на специальных торговых площадках</th>                             
                    </tr>
                    
                    <tr>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th>количество</th>
                        <th>количество (сум)</th>
                        <th></th>
                    </tr>
                      
             </thead>
        </table>

        
           
        </table>
       </div>
    </div>

      
   
        <script>
            $(document).ready(function() {
                $('#yajra-datatable').DataTable( {
                    // dom: 'PQlfrtip',
                    dom: 'Qlfrtip',
                    ajax:
                        "{{ route('report','9') }}",

                    columns: [
                        {data: "id", name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'shartnomalar', name: 'shartnomalar'},
                        {data: 'tender', name: 'tender'},
                        {data: 'Otbor', name: 'Otbor'},
                        {data: 'Eshop', name: 'Eshop'},
                        {data: 'Elektron_auksiyon', name: 'Elektron_auksiyon'},
                        {data: 'кооперационный_портал', name: 'кооперационный_портал'},
                        {data: 'Konkrus', name: 'Konkrus'},
                        {data: 'электронный_магазин(E-Shop)', name: 'электронный_магазин(E-Shop)'},
                        {data: 'тендер', name: 'тендер'},
                        {data: 'госзакупок_в_сфере_строительства', name: 'госзакупок_в_сфере_строительства'},
                        {data: 'через_электронные_биржевые_торги_на_специальных_торговых_площадках', name: 'через_электронные_биржевые_торги_на_специальных_торговых_площадках'},
                    ]
                });
            });
        </script>
    @endsection
