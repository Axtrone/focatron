<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @include('layouts.navigation')

        <div class="container my-5 max-w-6xl mx-auto">
            {{ $slot }}
        </div>
    </body>
</html>
