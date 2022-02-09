{{--<div class="w-2/12 h-screen float-left bg-blue-500 fixed">--}}
{{--    <div class="w-10/12 mx-auto my-10">--}}
{{--        <img src="{{ asset('images/logo.png') }}" alt="">--}}
{{--    </div>--}}
{{--    <div class="border-t border-white">--}}
{{--        <div class="mt-4 w-10/12 mx-auto">--}}
{{--            <ul>--}}
{{--                {{menu('site', 'site.dashboard.menu')}}--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<nav aria-label="alternative nav">

    <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full content-center">
        <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                {{menu('site', 'site.dashboard.menu')}}
            </ul>
        </div>
    </div>

</nav>
