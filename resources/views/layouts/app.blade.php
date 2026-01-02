<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nowaits - @yield('title')</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">


    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>



    @stack('scripts')
</body>
</html>
