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
    <div class="bg-gray-800 shadow-xl fixed bottom-0 md:relative md:h-screen z-10 w-full content-center">

        <a href="/" class="flex items-start py-5 w-10/12 mx-auto">
            <img src="{{ asset('/images/Uztelecom_Logo.png') }}" alt="">
        </a>
        <div class="content-center md:content-start text-left justify-between">
            <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                {{menu('site', 'site.dashboard.menu')}}
            </ul>
        </div>
    </div>

</nav>
