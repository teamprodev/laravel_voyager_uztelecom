@extends('site.auth.layout')

@section('login')
    <div class="w-96">
        <div class="mt-4">
        <label class="block text-sm">
            Email Adress
        </label>
        <input type="email"
            class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
            placeholder="Email Address" />
        </div>
        <div>
        <label class="block mt-4 text-sm">
            Password
        </label>
        <input
            class="w-full px-4 py-2 text-sm border rounded-md focus:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-600"
            placeholder="Password" type="password" />
        </div>
        <div class="flex items-center mt-4">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
        </div>
        <button class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
        Login
        </button>
        <div class="mt-4">
            <a href="#" class="text-lg text-center text-gray-700 hover:text-red-500">Forgot your Password?</a>
        </div>
    </div>
@endsection                                                                                                             