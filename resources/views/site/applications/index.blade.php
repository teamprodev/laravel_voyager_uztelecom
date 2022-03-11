@extends('site.layouts.wrapper')
@section('center_content')
<div id="section" class="relative">
    <a href="{{route('site.applications.create')}}"
       class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8">
        Создать задания
    </a>
    <div class="w-11/12 mx-auto pt-8 pb-16">
        <table id="yajra-datatable">
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
        </table>
    </div>
</div>
@push('scripts')
<script>
  $(function () {

    var table = $('#yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax:
             "{{ route('site.applications.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'initiator', name: 'initiator'},
            {data: 'name', name: 'name'},
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
@endpush
@endsection
