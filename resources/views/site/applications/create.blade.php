@extends('site.layouts.wrapper')

@section('center_content')
    <div class="w-full text-right py-4 pr-10">
        <button class="btn btn-danger" onclick="functionBack()">Назад</button>
    </div>
    {{ Aire::open()
  ->route('site.applications.store')
  ->enctype("multipart/form-data")
  ->post() }}
        @include('site.applications.form')
    {{ Aire::close() }}
@endsection

<script>
    function functionBack()
    {
        window.history.back();
    }
</script>
