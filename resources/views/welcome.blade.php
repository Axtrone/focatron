<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Focibajnokság</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-screen bg-no-repeat bg-cover bg-bottom" style="background-image: url('/images/main_bg.jpg')">

        <nav class="">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <button data-collapse-toggle="navbar-dropdown" type="button" class="ms-auto inline-flex items-center p-3 ml-3 text-sm text-gray-300 rounded-lg md:hidden hover:bg-gray-500 backdrop-brightness-50 focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="navbar-dropdown" aria-expanded="false">
                <span class="sr-only">Menü megnyitása</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto md:mx-auto" id="navbar-dropdown">
                <ul class="bg-opacity-50 flex flex-col font-medium p-4 mt-4 border border-gray-100 rounded-lg bg-gray-100 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-gray-400 md:bg-opacity-50 md:rounded-3xl md:shadow-lg md:shadow-red-500 md:px-8">
                {{-- <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0" aria-current="page">Home</a>
                </li> --}}
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Mérkőzések</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Csapatok</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Tabella</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Kedvenceim</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>

        <h1 class="mt-6 text-center text-4xl font-semibold">Foca bajnokság</h1>
    </body>
</html>
