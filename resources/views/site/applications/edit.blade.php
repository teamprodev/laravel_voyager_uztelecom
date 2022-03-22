@extends('site.layouts.wrapper')

@section('center_content')
    <div class="my-1">
        <button class="btn btn-danger" onclick="functionBack()">Назад</button>
    </div>
    <form action="{{ route('site.applications.update', $application->id) }}" method="post">
        @csrf
        @include('site.applications.formedit')
    </form>
@endsection

<script>
    function functionBack()
    {
        window.history.back();
    }
</script>
