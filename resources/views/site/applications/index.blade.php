@extends('site.layouts.wrapper')
@section('center_content')

    <a href="{{route('site.applications.create')}}"
       class="ml-12 bg-blue-500 hover:bg-blue-700 p-2 transition duration-300 rounded-md text-white mb-8"
    >
        Создать задания
    </a>
    <div class="w-11/12 mx-auto mt-6">

        <table id="table_id" class="display">
            <thead>
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="1">Ташаббускор (буюртмачи номи )</th>
                <th data-priority="2">Сотиб олинадиган махсулот номи (махсулот, иш, хизмат)</th>
                <th data-priority="3">Махсулот келишининг муддати</th>
                <th data-priority="4">Харид режаси (сумма)</th>
                <th data-priority="6">Махсулотни келтириш учун қўйилган талаб INCOTERMS, (омбордан олиб кетиш/ харидорга етказиб бериш)</th>
                <th data-priority="8">Дата создания</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
{{--            @dd($applications)--}}
            @foreach($applications as $application)
                <tr class="text-center">
                    <td>{{ $application->id }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->specification }}</td>
                    <td>{{ $application->delivery_date }}</td>
                    <td>{{ $application->amount }} {{ $application->currency }}</td>
                    <td>{{ $application->incoterms }}</td>
                    <td>{{ $application->created_at }}</td>
                    <td class="w-48">
                        <a href="{{ route('site.applications.edit',$application->id) }}">
                            <button type="button" class="inline-block px-6 py-2.5 bg-blue-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-600 hover:shadow-lg focus:bg-blue-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-700 active:shadow-lg transition duration-150 ease-in-out">Edit</button>
                        </a>
                        <a href="{{ route('site.applications.show', $application->id) }}">
                            <button type="button" class="inline-block px-6 py-2.5 bg-yellow-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out">Show</button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <script>
        var buttonCommon = {
            exportOptions: {
                format: {
                    body: function ( data, row, column, node ) {
                        // Strip $ from salary column to make it numeric
                        return column === 5 ?
                            data.replace( /[$,]/g, '' ) :
                            data;
                    }
                }
            }
        };
        $(document).ready(function() {
            $('#table_id').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    } )
                ]
            } );
        } );

    </script>
@endsection
