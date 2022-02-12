@extends('site.layouts.wrapper')

@section('center_content')
    <form action="{{ route('site.applications.store') }}" method="post">
        @csrf
        @include('site.applications.form')
    </form>

@endsection
