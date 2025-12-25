<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nowaits - @yield('title')</title>


    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">


    <div class="w-full max-w-md">
      
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-4xl font-extrabold text-green-600">Nowaits</a>
            <p class="text-gray-500 mt-2">Masuk atau Daftar untuk melanjutkan</p>
        </div>


        <div class="bg-white p-8 rounded-lg shadow-md">
            @yield('content')
        </div>

        <div class="text-center mt-6 text-sm text-gray-500">
            &copy; {{ date('Y') }} Nowaits
        </div>
    </div>

</body>
</html>
