<x-main title="Mérkőzés">
    <div class="mx-auto max-w-3xl">
        {{-- Content --}}
        <div class="flex flex-row gap-2">
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
        </div>

        @if ($g->start < now())
            <h2 class="text-xl font-bold font-sans mt-6 ms-3 mb-2 md:text-2xl md:mt-11 md:text-center">Események</h2>
            <div class="mx-auto max-w-xl relative">
            @foreach ($g->events as $e)
                <div class="mx-2 p-4 mb-2 bg-white border border-gray-200 rounded-lg shadow flex flex-row items-center justify-between">
                    <div>
                        <p><i class="fa-solid fa-user me-2 mb-2"></i>{{ $e->player->name }} <span class="italic">({{ $e->player->team->name }})</span></p>
                        <p><i class="fa-solid fa-t me-2 mb-2"></i>{{ __($e->type) }}</p>
                        <p><i class="fa-regular fa-clock me-2 mb-2"></i>{{ $e->minute }}`</p>
                    </div>
                    <img src="/images/{{ $e->type }}.svg" class="max-h-20 me-2">
                </div>
            @endforeach
            {{-- TODO: Csak admin láthatja --}}
            <div class="flex justify-center">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mt-2"><i class="fa-solid fa-plus me-2"></i>Új esemény rögzítése</button>
            </div>

            </div>
        @else
            <h2 class="text-xl font-bold font-sans mt-6 text-center mb-2 italic">Az esemény még nem kezdődött el!</h2>
        @endif
    </div>
</x-main>

