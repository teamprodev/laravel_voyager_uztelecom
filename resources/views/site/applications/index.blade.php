@extends('site.layouts.wrapper')

@section('center_content')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
@endsection
