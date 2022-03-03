@extends('site.layouts.wrapper')

@section('center_content')
    {{ Aire::open()
  ->route('site.applications.store')
  ->post() }}
        @include('site.applications.form')
    {{ Aire::close() }}
@endsection
