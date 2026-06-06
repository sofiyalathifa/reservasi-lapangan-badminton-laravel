@extends('layouts.auth')

@section('title', 'Home')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 px-6 w-full">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <img class="mx-auto h-12 w-auto" src="https://www.svgrepo.com/show/301692/login.svg" alt="Workflow">
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            Create a new account
        </h2>
        <p class="mt-2 text-center text-sm leading-5 text-green-500 max-w">
            Or
            <a href="{{ route('login') }}"
                class="font-medium text-green-600 hover:text-teal-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                login to your account
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-white py-10 px-8 shadow-lg sm:rounded-xl sm:px-10">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="name" name="name" placeholder="John Doe" type="text" required="" value="{{ old('name') }}"
                            class="appearance-none block w-full px-4 py-3 border @error('name') border-red-300 @else border-gray-300 @enderror rounded-lg placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-base leading-5">
                    </div>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>



                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Email address
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="email" name="email" placeholder="user@example.com" type="email"
                            required="" value="{{ old('email') }}" autocomplete="off"
                            class="appearance-none block w-full px-4 py-3 border @error('email') border-red-300 @else border-gray-300 @enderror rounded-lg placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-base leading-5">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                        Password
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password" name="password" type="password" required="" autocomplete="new-password" placeholder="••••••••"
                            class="appearance-none block w-full px-4 py-3 border @error('password') border-red-300 @else border-gray-300 @enderror rounded-lg placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-base leading-5">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                        Confirm Password
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password_confirmation" name="password_confirmation" type="password" required="" autocomplete="new-password" placeholder="••••••••"
                            class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-base leading-5">
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent text-base font-bold rounded-lg 
                            text-white bg-gradient-to-r from-green-500 to-teal-500 
                            hover:from-green-600 hover:to-teal-600 
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 
                            transition duration-150 ease-in-out">
                            Create account
                        </button>
                    </span>
                </div>
            </form>

        </div>
    </div>
</div>