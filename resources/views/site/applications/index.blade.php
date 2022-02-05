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
<div class="px-8">
    <div class="flex">
        <div class=" m-4">
            <a href="{{route('site.applications.create')}}" class="bg-blue-500 hover:bg-blue-700 h-18 transition duration-300 rounded-md text-white cursor-pointer py-2 px-2 w-full text-base">Создать новую заявку</a>
        </div>

        <div class="overflow-hidden relative h-18 w-24 my-2 rounded-md cursor-pointer mr-3">
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 w-full inline-flex items-center">
                <svg fill="#FFF" height="16" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                </svg>
                <span class="ml-2">PDF</span>
            </button>
        </div>
        <div class="overflow-hidden relative h-18 w-24 my-2 rounded-md cursor-pointer">
            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 w-full inline-flex items-center">
                <svg fill="#FFF" height="16" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                </svg>
                <span class="ml-2">Excel</span>
            </button>
        </div>
    </div>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

        <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="1">Ташаббускор (буюртмачи номи )</th>
                <th data-priority="2">Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                <th data-priority="3">Махсулот келишининг муддати</th>
                <th data-priority="4">Харид режаси (сумма)</th>
                <th data-priority="5">Валюта</th>
                <th data-priority="6">Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)</th>
                <th data-priority="7">Изох</th>
                <th data-priority="8">Дата создания</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>AAA</td>
                    <td>BBB</td>
                    <td>CCC</td>
                    <td>DDD</td>
                    <td>EEE</td>
                    <td>123</td>
                    <td>FFF</td>
                    <td>GGG</td>
                    <td>2022-02-03 06:43:45</td>
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
