@extends('site.layouts.wrapper')

@section('center_content')

   <div class="container mx-auto flex flex-col mt-32 mr-8">
       @foreach($faqs as $faq)
           <div class="flex justify-between items-center my-3 w-full mx-auto bg-green-100 px-6 py-2">
               <h1 class="text-lg text-black font-normal">{{$faq->title}}</h1>
               <a href="{{route('site.faqs.show', $faq)}}" class="bg-blue-500 hover:bg-blue-700 text-white py-2
           px-5">View</a>
           </div>
       @endforeach
   </div>
@endsection
