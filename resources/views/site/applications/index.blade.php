@extends('site.layouts.wrapper')
@section('center_content')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

    <a href="{{route('site.applications.create')}}"
       class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8"
    >
        Создать задания
    </a>
    <div class="w-11/12 mx-auto pt-8 pb-16">

        <table   class="border-collapse border rounded-t border-slate-400 yajra-datatable">
            <thead class="mt-8">
            <tr class="border text-center pt-8">
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600" >Id</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600" >Ташаббускор (буюртмачи номи )</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600 uppercase tracking-wider" >Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600 uppercase tracking-wider" >Махсулот келишининг муддати</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600 uppercase tracking-wider" >Харид режаси (сумма)</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600 uppercase tracking-wider" >Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600 uppercase tracking-wider" >Дата создания</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100  text-sm font-semibold text-gray-600 uppercase tracking-wider" style="width: 150px;">Action</th>
            </tr>
            </thead>
            <tbody class="text-center">

            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {

    var table = $('.yajra-datatable').DataTable({
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
@endsection
