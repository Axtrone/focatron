<x-main title="Mérkőzés">
    <div class="mx-auto max-w-3xl">
        {{-- Content --}}
        <div class="flex flex-row gap-2">
            <div class="basis-3/5 text-center px-2 md:flex md:flex-row md:items-center">
                <span class="md:basis-1/2"><img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $g->home_team->image ? Storage::url('logos/'. $g->home_team->image) : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo"></span>
                <div class="md:basis-1/2">
                    <h4 class="mt-1 font-bold font-mono md:text-xl md:justify-self-end">{{ $g->home_team->name }}</h4>
                    <h5 class="hidden md:inline font-semibold font-mono italic text-lg">{{ $g->home_team->shortname }}</h5>
                </div>
            </div>
            <div class="basis-1/7 text-center flex flex-col justify-between">
                <p class="text-2xl font-bold italic font-serif">{{ $g->start < now() ? $g->results['home_team'] . " - " . $g->results['away_team'] : "VS" }}</p>
                <p class="">{{ date_format(date_create($g->start), 'Y.m.d') }}</p>
                <p class="font-bold align-bottom">{{ date_format(date_create($g->start), 'H:i') }}</p>
            </div>
            <div class="basis-3/5 text-center px-2 md:flex md:flex-row md:items-center">
                <span class="md:basis-1/2"><img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $g->away_team->image ? Storage::url('logos/'. $g->away_team->image) : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo"></span>
                <div class="md:order-first md:basis-1/2">
                    <h4 class="mt-1 font-bold font-mono md:text-xl">{{ $g->away_team->name }}</h4>
                    <h5 class="hidden md:inline font-semibold font-mono italic md:text-lg">{{ $g->away_team->shortname }}</h5>
                </div>
            </div>
        </div>

        @if ($g->start < now())
            <h2 class="text-xl font-bold font-sans mt-6 ms-3 md:ms-0 mb-2 md:text-2xl md:mt-11 md:text-center">Események</h2>
            <div class="mx-auto max-w-xl relative">
                @foreach ($g->events as $e)
                    <div class="mx-2 p-4 mb-2 bg-white border border-gray-200 rounded-lg shadow flex flex-row items-center justify-between">
                        <div>
                            <p><i class="fa-solid fa-user me-2 mb-2"></i><span class="text-lg">{{ $e->player->name }}</span> <span class="italic">({{ $e->player->team->name }})</span></p>
                            <p><i class="fa-solid fa-t me-2 mb-2"></i>{{ __($e->type) }}</p>
                            <p><i class="fa-regular fa-clock me-2 mb-2"></i>{{ $e->minute }}`</p>
                        </div>
                        <img src="/images/{{ $e->type }}.svg" class="max-h-20 me-2">
                        @can('delete',[\App\Event::class, $e, $g])
                        <form action="{{ route('events.destroy', ['event' => $e]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" id="game_id" name="game_id" value="{{ $g->id }}">
                            <button type="submit" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                        @endcan
                    </div>
                @endforeach
                @can('create', [\App\Event::class, $g])
                    <x-new-model-modal open="{{ count($errors) == 0 ? 'false' : 'true' }}" title="Új esemény hozzáadása">
                        <form class="mt-5" method="POST" action="{{ route('events.store') }}">
                            <input type="hidden" id="game_id" name="game_id" value="{{ $g->id }}">
                            @csrf

                            <div>
                                <x-input-label for="minute" value="Perc" class="text-lg" />
                                <x-text-input id="minute" class="block mt-1 w-full" type="number" name="minute" :value="old('minute')" autofocus min='0' max='90' />
                                <x-input-error :messages="$errors->get('minute')" class="mt-2" />
                            </div>

                            <div class="mt-3">
                                <x-input-label for="type" value="Esemény típusa" class="text-lg" />
                                <select id="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="type">
                                    <option {{ old('type') == 'goal' ? "selected" : "" }} value="goal">Gól</option>
                                    <option {{ old('type') == 'own_goal' ? "selected" : "" }} value="own_goal">Öngól</option>
                                    <option {{ old('type') == 'yellow_card' ? "selected" : "" }} value="yellow_card">Sárga lap</option>
                                    <option {{ old('type') == 'red_card' ? "selected" : "" }} value="red_card">Piros lap</option>
                                </select>
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />
                            </div>

                            <div class="mt-3">
                                <x-input-label for="player" value="Játékos" class="text-lg" />
                                <select id="player_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="player_id">
                                    @forelse ($g->home_team->players as $p)
                                        <option {{ old('player_id') == $p->id ? "selected" : "" }} value="{{ $p->id }}"><span class="italic">({{ $p->number }}) </span>{{ $p->name }}</option>
                                    @empty
                                        <option value="error">Nincsenek játékosok</option>
                                    @endforelse
                                    <option disabled role=separator>----------------------------</option>
                                    @forelse ($g->away_team->players as $p)
                                        <option {{ old('player_id') == $p->id ? "selected" : "" }} value="{{ $p->id }}"><span class="italic">({{ $p->number }}) </span>{{ $p->name }}</option>
                                    @empty
                                        <option value="error">Nincsenek játékosok</option>
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('player_id')" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-6">
                                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    Mentés
                                </button>
                            </div>
                        </form>
                    </x-new-model-modal>
                    <div class="flex justify-center my-3">
                        <form action="{{ route('games.close', ['game' => $g])}}" method="POST">
                            @csrf
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center">
                                <span><i class="fa-solid fa-xmark me-2"></i>Meccs lezárása</span>
                            </button>
                        </form>
                    </div>
                @endcan
            </div>
        @else
            <h2 class="text-xl font-bold font-sans mt-6 text-center mb-2 italic">Az esemény még nem kezdődött el!</h2>
        @endif
    </div>
</x-main>

