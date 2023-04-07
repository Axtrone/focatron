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

        <footer class="rounded-lg border-t border-gray-300 pt-2">
                <span class="block text-sm text-gray-500 text-center dark:text-gray-400">© 2023 <strong>Varga Bence</strong></span>
            </div>
        </footer>
    </body>
</html>
