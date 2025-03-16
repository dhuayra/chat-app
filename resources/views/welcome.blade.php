<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="icon" href="{{ asset('./logo.png') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body style="background-image: url({{ asset('./bg.jpg') }}); background-size: cover; background-position: center;" class="h-screen flex justify-center items-center">
    <div class="flex justify-center items-center w-full h-full bg-dots-darker bg-center">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <div class="text-center text-white">
                    <h1 class="text-4xl font-bold text-gray-300">Welcome to My Laravel Chat App</h1>
                    <p class="mt-4 text-xl text-gray-500">Register or login to try this application</p>
                </div>
            </div>
            @if (Route::has('login'))
                <div class="flex justify-center mt-6">
                    @auth
                        <a href="{{ url('/home') }}" class="px-6 py-3 m-3 bg-white bg-opacity-10 backdrop-blur-md text-gray-300 font-semibold rounded-lg hover:bg-opacity-50 hover:text-gray-800 transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-3 m-3 bg-white bg-opacity-10 backdrop-blur-md text-gray-300 font-semibold rounded-lg hover:bg-opacity-50 hover:text-gray-800 transition-all">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 m-3 bg-white bg-opacity-10 backdrop-blur-md text-gray-300 font-semibold rounded-lg hover:bg-opacity-50 hover:text-gray-800 transition-all">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="flex justify-end mt-16 px-0 sm:items-center sm:justify-between">
                <div class="text-center text-sm sm:text-left">
                    &nbsp;
                </div>

                <div class="text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</body>
</html>
