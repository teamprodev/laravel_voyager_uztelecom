@extends('site.layouts.app')

@section('center_content')
    <div class="pl-4 pt-4">
        <button class="btn btn-danger" onclick="functionBack()">Назад</button>
    </div>
    <form action="{{ route('site.applications.update', $application->id) }}" method="post">
        @csrf
        @include('site.applications.formedit')
    </form>

    <script>
        function functionBack()
        {
            window.history.back();
        }
    </script>
@endsection

