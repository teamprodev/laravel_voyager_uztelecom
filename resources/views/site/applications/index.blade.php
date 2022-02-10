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
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "ajax": "data/arrays.txt",
                "deferRender": true
            } );
        } );
    </script>
@endsection
{{--buttons: [--}}
{{--$.extend( true, {}, buttonCommon, {--}}
{{--extend: 'copyHtml5'--}}
{{--} ),--}}
{{--$.extend( true, {}, buttonCommon, {--}}
{{--extend: 'excelHtml5'--}}
{{--} ),--}}
{{--$.extend( true, {}, buttonCommon, {--}}
{{--extend: 'pdfHtml5'--}}
{{--} )--}}
{{--]--}}
