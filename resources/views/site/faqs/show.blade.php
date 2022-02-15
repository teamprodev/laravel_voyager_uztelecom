@extends('site.layouts.wrapper')

@section('center_content')

    <div class="container mx-auto">
        <h1 class="text-center text-3xl font-semibold">
            {{$faq->title}}
        </h1>
        <p class="text-lg mt-12 w-11/12 mx-auto">
            {{$faq->description}}
        </p>
    </div>

@endsection
