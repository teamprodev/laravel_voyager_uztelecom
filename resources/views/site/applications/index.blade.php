@extends('site.layouts.wrapper')
@section('center_content')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://pagecdn.io/lib/font-awesome/5.10.0-11/css/all.min.css" integrity="sha256-p9TTWD+813MlLaxMXMbTA7wN/ArzGyW/L7c5+KkjOkM=" crossorigin="anonymous">

{{--<div id="preloader" class="w-full fixed h-screen block bg-white -mt-8 -ml-32" style="z-index: 8">--}}
{{--  <span class="text-blue-500 opacity-75 top-1/3 my-0 mx-auto block relative w-0 h-0">--}}
{{--    <i class="fas fa-circle-notch fa-spin fa-5x"></i>--}}
{{--  </span>--}}
{{--</div>--}}
<div id="section" class="relative">
    <a href="{{route('site.applications.create')}}"
       class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
        Создать задания
    </a>
    <div class="w-11/12 mx-auto pt-8 pb-16">
        <table id="yajra-datatable" class="table table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Ташаббускор (буюртмачи номи )</th>
                <th >Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                <th >Махсулот келишининг муддати</th>
                <th >Харид режаси (сумма)</th>
                <th>Махсулотни келтириш учун қўйилган талаб INCOTERMS</th>
                <th >Дата создания</th>
                <th >Статус</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="text-center text-sm">
                @foreach($applications as $application)
                    <tr>
                        <td>{{$application->id}}</td>r
                        <td>{{$application->initiator}}</td>
                        <td>{{$application->name}}</td>
                        <td>{{$application->delivery_date}}</td>
                        <td>{{$application->amount}}</td>
                        <td>{{$application->inconterms}}</td>
                        <td>{{$application->created_at}}</td>
                        <td>{{$application->status}}</td>
                        <td><a class="btn btn-warning" href="{{route('site.applications.edit', $application->id)
                        }}">Edit</a>
                        <a class="btn btn-primary" href="{{route('site.applications.show', $application->id)
                        }}">Show</a></td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
{{--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>--}}
<script type="text/javascript">
  $(function () {

    var table = $('#yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:
             "{{ route('site.applications.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'specification', name: 'specification'},
            {data: 'delivery_date', name: 'delivery_date'},
            {
                "data": "",
                render: function (data, type, row) {
                        var details = row.amount + " " + row.currency ;
                            return details;
                    }
            },
            {data: 'incoterms', name: 'incoterms'},

            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });


  });

</script>
{{--<script>--}}
{{--    $(window).on('load', function() {--}}
{{--        $('#preloader').fadeOut().end().delay(400).fadeOut('slow');--}}
{{--    });--}}
{{--</script>--}}
@endsection
