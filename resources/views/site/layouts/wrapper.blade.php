@extends('site.layouts.app')

<div class="w-2/12 ml-8"></div>
@section('menu-left')
    @include('site.dashboard.sidebar')
@endsection
@section('top-bar')
    @include('site.dashboard.navbar')
@endsection

@section('content')
    <div class="mt-24"></div>
    @yield('components')
    @yield('center_content')
@endsection

