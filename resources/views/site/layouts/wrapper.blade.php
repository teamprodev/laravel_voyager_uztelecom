@extends('site.layouts.app')

@section('menu-left')
    @include('site.dashboard.sidebar')
@endsection

@section('top-bar')
    @include('site.dashboard.navbar')
@endsection

@section('content')
    @yield('center_content')
@endsection

