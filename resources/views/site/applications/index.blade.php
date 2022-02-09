@extends('site.layouts.wrapper')
@section('center_content')
    <div class="w-11/12 mx-auto">

        <table id="example" class="display">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready(function() {
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

            $('#example').DataTable( {
                ajax: '{{ asset('js/objects.txt') }}',
                columns: [
                    { data: 'name' },
                    { data: 'position' },
                    { data: 'office' },
                    { data: 'extn' },
                    { data: 'start_date' },
                    { data: 'salary' }
                ],
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
