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
                <ul class="bg-opacity-50 flex flex-col font-medium p-4 mt-4 border border-gray-100 rounded-lg bg-gray-100 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-gray-400 md:bg-opacity-50 md:rounded-3xl md:shadow-lg md:shadow-green-500 md:px-8"> {{--md:shadow-red-500--}}
                <li>
                    <a href="{{ route('games.index') }}" class="text-lg block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Mérkőzések</a>
                </li>
                <li>
                    <a href="{{ route('teams.index') }}" class="text-lg block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Csapatok</a>
                </li>
                <li>
                    <a href="{{ route('table')}} " class="text-lg block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Tabella</a>
                </li>
                <li>
                    <a href="{{ route('favourites') }}" class="text-lg block py-2 pl-3 pr-4 text-gray-900 font-bold rounded md:hover:bg-transparent md:border-0 md:p-0 hover:bg-gray-700 hover:text-white">Kedvenceim</a>
                </li>
                </ul>
            </div>
            </div>
        </nav>

        <div class="container mx-auto max-w-md">
            <div class="bg-gray-400 bg-opacity-50 m-2 rounded-xl text-center p-4 mt-0 md:mt-10">
                <h1 class="text-4xl font-semibold font-mono">Focatron</h1>
                <p>Üdvözöllek a <strong>Focatron hivatalos weboldalán</strong>.</p>
                <p class="text-justify">Cégünk 2009-ben alakult, a digitális forradalom elején. Célunk azóta is a magyar futball <strong>digitalizációja</strong>, egy kényelmes internetes tér nyújtása a sportág rajongóinak</p>
                <p class="italic mt-2">Kérlek válassz menüpontot a <strong>fenti lehetőségek</strong> közül.</p>
            </div>
        </div>
    </body>
</html>
