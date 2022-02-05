@extends('site.layouts.wrapper')

@section('center_content')
    <style>
        .dataTables_wrapper select,
        .dataTables_wrapper .dataTables_filter input {
            color: #4a5568;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-top: .5rem;
            padding-bottom: .5rem;
            line-height: 1.25;
            border-width: 2px;
            border-radius: .25rem;
            border-color: #edf2f7;
            background-color: #edf2f7;
            outline: none;
        }

        /*Row Hover*/
        table.dataTable.hover tbody tr:hover,
        table.dataTable.display tbody tr:hover {
            background-color: #ebf4ff;
            /*bg-indigo-100*/
        }

        /*Pagination Buttons*/
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Current selected */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Pagination Buttons - Hover */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: #fff !important;
            /*text-white*/
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
            /*shadow*/
            font-weight: 700;
            /*font-bold*/
            border-radius: .25rem;
            /*rounded*/
            background: #667eea !important;
            /*bg-indigo-500*/
            border: 1px solid transparent;
            /*border border-transparent*/
        }

        /*Add padding to bottom border */
        table.dataTable.no-footer {
            border-bottom: 1px solid #e2e8f0;
            /*border-b-1 border-gray-300*/
            margin-top: 0.75em;
            margin-bottom: 0.75em;
        }

        /*Change colour of responsive icon*/
        table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
        table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
            background-color: #667eea !important;
            /*bg-indigo-500*/
        }
    </style>
<!--Container-->
<div class="container w-full md:w-4/5 2xl:ml-90 lg:ml-52 xl:ml-72 md:ml-44 mt-6 px-2">
<div class=" my-4">
    <a href="{{route('site.applications.create')}}" class="bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white">Создать новую заявку</a>
</div>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

        <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="1">Name</th>
                <th data-priority="2">User</th>
                <th data-priority="3">Office</th>
                <th data-priority="4">Age</th>
                <th data-priority="5">Start date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{$application->id}}</td>
                    <td>{{$application->name}}</td>
                    <td>{{$application->user->name}}</td>
                    <td>61</td>
                    <td>2011/04/25</td>
                    <td>$320,800</td>
                </tr>
            @endforeach
            </tbody>

        </table>


    </div>
    <!--/Card-->


</div>
<!--/container-->
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true
        })
            .columns.adjust()
            .responsive.recalc();
    });
</script>
@endsection
