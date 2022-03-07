@extends('site.layouts.wrapper')

@section('center_content')
    <form action="{{ route('site.applications.update', $application->id) }}" method="post">
        @csrf
        @include('site.applications.formedit')
    </form>
@endsection
