<nav class="bg-white fixed w-10/12 z-50 right-0 border-gray-200 sm:px-4 py-2.5 dark:bg-gray-800 border-b shadow-md">
    <div class="flex justify-between flex-wrap items-center mx-auto">
        <div class="hidden relative w-5/12 mr-3 md:block">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
            </div>
            <input type="text" id="email-adress-icon" class="focus:outline-none block p-2 pl-10 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
        </div>
        <div class="flex md:order-2">
            <button data-collapse-toggle="mobile-menu-3" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-3" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>

        <div>
            <div class="">
                <div class="w-4 h-4 absolute rounded-full bg-red-500 ml-3 text-white text-center -mt-2">
                <span class="text-xs">
                    5
                </span>
                </div>
                <button class="" type="button">
                    <i class="text-xl text-gray-500 far fa-bell"></i>
                </button>
            </div>
        </div>
        <div class="flex w-28">
            <div class="px-5 py-4 flex justify-end">
                <ul>
                    <li>
                        <select name="lang" id="lang" class="text-black mr-4 border-0 focus:outline-none">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option value="0" class="border-0 rounded">
                                    <a class="mr-5" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </option>
                            @endforeach
                        </select>
                    </li>
                </ul>
{{--                <a href="{{route('register')}}" class="text-black hover:text-gray-800  mr-5">Register</a>--}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            @auth
            <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                <li class="flex-1 md:flex-none md:mr-3">
                    <div class="relative inline-block">
                        <button onclick="toggleDD('myDropdown')" class="drop-button text-black py-2 px-2">
                            <span class="pr-2">
                                <i class="em em-robot_face"></i>
                            </span>{{auth()->user()->name}}
                            <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                            </svg>
                        </button>
                        <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-black right-0 mt-3 p-3 overflow-auto z-30 invisible">
                            <input type="text" class="drop-search focus:outline-none rounded p-2 text-gray-600" placeholder="Search.." id="myInput" onkeyup="filterDD('myDropdown','myInput')">
                            <a href="{{route('site.profile.index')}}" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                            <div class="border border-gray-800"></div>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <i class="fas fa-sign-out-alt fa-fw text-white">  <input type="submit" class="p-2 bg-gray-800 text-white text-sm no-underline hover:no-underline block text-white cursor-pointer" value="Выйти">
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
            @else
                <a href="{{route('login')}}" class="text-black hover:text-gray-500  ml-5">Login</a>
            @endauth
        </div>
    </div>
</nav>
