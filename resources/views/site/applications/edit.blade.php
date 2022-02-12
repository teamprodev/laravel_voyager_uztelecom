@extends('site.applications.index')

@section('center_content')
    <form action="{{ route('site.applications.update') }}" method="post">
        @csrf
        @include('site.applications.form')
    </form>
@endsection
