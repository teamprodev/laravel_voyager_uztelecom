@extends('site.layouts.app')

<div class="w-2/12 ml-8"></div>
@section('menu-left')
    @include('site.dashboard.sidebar')
@endsection
@section('top-bar')
    @include('site.dashboard.navbar')
@endsection

@section('content')
    <div class="mt-24">
        @if(session()->has('success'))
            <div class="alert alert-success w-full bg-green-500">
                {{ session()->get('success') }}
            </div>
        @endif
        @if(session()->has('danger'))
            <div class="alert alert-success w-full bg-red-500">
                {{ session()->get('danger') }}
            </div>
        @endif
    </div>
    @yield('components')
    @yield('center_content')
@endsection

