@extends('site.layouts.wrapper')

@section('center_content')
    {{ Aire::open()
  ->route('site.applications.store')
  ->enctype("multipart/form-data")
  ->post() }}
        @include('site.applications.form')
    {{ Aire::close() }}
@endsection
