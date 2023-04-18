<x-main title="Mérkőzések">
<div class="max-w-xl md:max-w-3xl mx-auto">
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-2">Mérkőzések</h1>
    @if(!$live_games->isEmpty())
    {{-- Actual games --}}
    <div id="current" class="border-2 border-red-600  mx-0.5 rounded-lg relative">
        <h2 class="absolute left-5 -top-4 px-1 bg-white text-red-600 font-semibold italic">Aktuális</h2>
        @foreach ($live_games as $lg)
            {{-- Card --}}
            <a href="{{ route('games.show', ['game' => $lg]) }}" class="my-4 p-3 mx-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex flex-row gap-2">
                <div class="basis-2/5 text-center px-2 md:flex md:flex-row md:items-center">
                    <span class="md:basis-1/2"><img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $lg->home_team->image ? $lg->home_team->image : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo"></span>
                    <div class="md:basis-1/2">
                        <h4 class="mt-1 font-bold font-mono md:text-xl md:justify-self-end">{{ $lg->home_team->name }}</h4>
                        <h5 class="hidden md:inline font-semibold font-mono italic text-lg">{{ $lg->home_team->shortname }}</h5>
                    </div>
                </div>
                <div class="basis-1/5 text-center flex flex-col justify-between">
                    <p class="text-2xl font-bold italic font-serif">{{ $lg->results['home_team'] }} - {{ $lg->results['away_team'] }}</p>
                        <span class="flex items-center justify-center text-sm font-medium text-gray-900 relative">
                        <span class="relative flex h-3 w-3 mr-1">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>Élő</span>
                    <p class="">{{ date_format(date_create($lg->start), 'Y.m.d') }}</p>
                    <p class="font-bold align-bottom">{{ date_format(date_create($lg->start), 'H:i') }}</p>
                </div>
                <div class="basis-2/5 text-center px-2 md:flex md:flex-row md:items-center">
                    <span class="md:basis-1/2"><img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $lg->away_team->image ? $lg->away_team->image : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo"></span>
                    <div class="md:order-first md:basis-1/2">
                        <h4 class="mt-1 font-bold font-mono md:text-xl">{{ $lg->away_team->name }}</h4>
                        <h5 class="hidden md:inline font-semibold font-mono italic md:text-lg">{{ $lg->away_team->shortname }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    @endif

    {{-- Other games --}}
    <div>
        @forelse ($games as $g)
            {{-- Card --}}
            <a href="{{ route('games.show', ['game' => $g]) }}" class="my-4 p-3 mx-1.5 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex flex-row gap-2">
                <div class="basis-3/5 text-center px-2 md:flex md:flex-row md:items-center">
                    <span class="md:basis-1/2"><img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $g->home_team->image ? $g->home_team->image : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo"></span>
                    <div class="md:basis-1/2">
                        <h4 class="mt-1 font-bold font-mono md:text-xl md:justify-self-end">{{ $g->home_team->name }}</h4>
                        <h5 class="hidden md:inline font-semibold font-mono italic text-lg">{{ $g->home_team->shortname }}</h5>
                    </div>
                </div>
                <div class="basis-1/7 text-center flex flex-col justify-between">
                    <p class="text-2xl font-bold italic font-serif">{{ $g->finished ? $g->results['home_team'] . " - " . $g->results['away_team'] : "VS" }}</p>
                    <p class="">{{ date_format(date_create($g->start), 'Y.m.d') }}</p>
                    <p class="font-bold align-bottom">{{ date_format(date_create($g->start), 'H:i') }}</p>
                </div>
                <div class="basis-3/5 text-center px-2 md:flex md:flex-row md:items-center">
                    <span class="md:basis-1/2"><img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $g->away_team->image ? $g->away_team->image : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo"></span>
                    <div class="md:order-first md:basis-1/2">
                        <h4 class="mt-1 font-bold font-mono md:text-xl">{{ $g->away_team->name }}</h4>
                        <h5 class="hidden md:inline font-semibold font-mono italic md:text-lg">{{ $g->away_team->shortname }}</h5>
                    </div>
                </div>
            </a>
        @empty

        @endforelse

    </div>
    {{-- Pagintion --}}
    <div class="mx-auto">
        {{ $games->links() }}
    </div>

    <a href="{{ route('games.create') }}" class="fixed z-90 bottom-10 right-8 bg-blue-600 w-14 h-14 rounded-full drop-shadow-lg flex justify-center items-center text-white text-xl hover:bg-blue-700 hover:drop-shadow-2xl">
          <i class="fa-solid fa-plus text-white"></i>
    </a>
</div>
</x-main>
