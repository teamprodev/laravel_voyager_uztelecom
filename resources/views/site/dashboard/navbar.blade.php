<div class="w-full h-16 bg-gray-200">
    <div class="px-5 py-4 flex justify-end">
        <a href="#lang" class="text-gray-500 hover:text-black mr-5">RU</a>
        <a href="{{route('login')}}" class="text-gray-500 hover:text-black mr-5">Login</a>
        <a href="{{route('register')}}" class="text-gray-500 hover:text-black mr-5">Register</a>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>
