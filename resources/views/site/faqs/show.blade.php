@extends('site.layouts.app')

@section('center_content')

    <div class="container mx-auto pt-4">
        <h1 class="text-center text-3xl font-semibold">
            {{$faq->title}}
        </h1>
        <p class="text-lg mt-12 w-11/12 mx-auto">
            {{$faq->description}}
        </p>
    </div>

@endsection
