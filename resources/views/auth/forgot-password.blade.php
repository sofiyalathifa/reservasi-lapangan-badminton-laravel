@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 px-6 w-full">
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            Reset Password
        </h2>
        <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
            Masukkan email Anda dan kami akan mengirimkan link untuk mereset password Anda.
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-white py-10 px-8 shadow-lg sm:rounded-xl sm:px-10">
            
            @if (session('success'))
                <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="email" name="email" placeholder="user@example.com" type="email" required="" value="{{ old('email') }}" class="appearance-none block w-full px-4 py-3 border @error('email') border-red-300 @else border-gray-300 @enderror rounded-lg placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out text-base leading-5">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent text-base font-bold rounded-lg 
                            text-white bg-gradient-to-r from-green-500 to-teal-500 
                            hover:from-green-600 hover:to-teal-600 
                            focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 
                            transition duration-150 ease-in-out">
                            Kirim Link Reset Password
                        </button>
                    </span>
                </div>
                
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="font-medium text-green-500 hover:text-teal-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Kembali ke halaman Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
