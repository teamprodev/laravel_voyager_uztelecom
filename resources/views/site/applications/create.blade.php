@extends('site.layouts.wrapper')

@section('center_content')
    <div class="w-full text-right py-4 pr-10">
        <button class="btn btn-danger" onclick="functionBack()">Назад</button>
    </div>
    {{ Aire::open()
  ->route('site.applications.store')
  ->enctype("multipart/form-data")
  ->rules([
    'planned_price' => 'numeric',
    'equal_planned_price' => 'numeric|required',
    'planned_price' => 'numeric|required',
    ])
    ->messages([
    'accepted' => 'You must accept the terms',
    ])
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
