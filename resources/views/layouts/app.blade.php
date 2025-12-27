<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nowaits - @yield('title')</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">


    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-green-600">Nowaits</div>
            <div>
             
                <a href="{{ route('home') }}" class="px-3 py-2 text-gray-600 hover:text-green-600">Home</a>
                <a href="{{ route('login') }}" class="px-3 py-2 text-gray-600 hover:text-green-600">Login</a>
                <a href="{{ route('register') }}" class="px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700">Register</a>
            </div>
        </nav>
    </header>

  
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>



</body>
</html>
