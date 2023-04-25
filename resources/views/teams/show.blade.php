<x-main title="Csapatok">
    @if (Session::has('team-edited'))
        <x-toast created="Csapat" event="módosítva"/>
    @endif
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-3">Csapatrészletező</h1>

    <div class="mx-2">
        <div class="bg-white rounded-lg shadow p-2 text-center flex justify-evenly max-w-md mx-auto">
            <div class="flex items-center">
                <img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $t->image ? Storage::url('logos/'. $t->image) : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo">
            </div>
            <div>
                <x-fav-button team="{{$t->id}}"/><p class="font-bold font-mono text text-xl">{{ $t->name }}</p>
                <p class="font-semibold font-mono italic text-lg">{{ $t->shortname }}</p>
            </div>
            @can('update', \App\Team::class)
            <div class="flex items-center">
                <a href="{{ route('teams.edit', ['team' => $t]) }}" class="h-fit text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    <i class="fa-regular fa-pen-to-square"></i>
                </a>
            </div>
            @endcan
        </div>
        <div class="lg:flex lg:flex-row lg:gap-5">
            <div class="bg-white rounded-lg shadow-md p-2 text-center mt-5">
                <h2 class="text-lg font-semibold mb-3">Játékosok adatai</h2>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Név
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Születési dátum
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Gólok száma
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Öngólók száma
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Piros/sárga lapok
                                </th>
                                @can('create', \App\Player::class)
                                <th scope="col" class="px-6 py-3">
                                    Törlés
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($t->players as $p)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $p->number }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $p->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ date_format(date_create($p->birthdate), 'Y.m.d') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $players_stats[strval($p->id)]['goal'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $players_stats[strval($p->id)]['own_goal'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $players_stats[strval($p->id)]['red_card'] }} / {{ $players_stats[strval($p->id)]['yellow_card'] }}
                                    </td>
                                    @can('create', \App\Player::class)
                                        @can('delete', [\App\Player::class, $players_stats[strval($p->id)]])
                                            <td class="px-6 py-4">
                                                <form action="{{ route('players.destroy', ['player' => $p]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @else
                                        <td></td>
                                        @endcan
                                    @endcan
                                </tr>
                            @empty
                                <td colspan="100%" class="text-lg font-bold italic text-center">Nincsenek játékosok</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @can('create', \App\Player::class)
                    <x-new-model-modal open="{{ count($errors) == 0 ? 'false' : 'true' }}" title="Új játékos hozzáadása">
                        <form class="mt-5" action="{{ route('players.store') }}" method="POST">
                            @csrf

                            <input type="hidden" id="team_id" name="team_id" value="{{ $t->id }}">
                            <div>
                                <x-input-label for="name" value="Név" class="text-lg" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <x-input-label for="number" value="Mezszám" class="text-lg" />
                                <x-text-input id="number" class="block mt-1 w-full" type="number" name="number" :value="old('number')" autofocus />
                                <x-input-error :messages="$errors->get('number')" class="mt-2" />
                            </div>
                            <div class="mt-3">
                                <x-input-label for="birthdate" value="Születési dátum" class="text-lg" />
                                <x-text-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" autofocus />
                                <x-input-error :messages="$errors->get('birthdate')" class="mt-2" />
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Mentés
                                </button>
                            </div>
                        </form>
                    </x-new-model-modal>
                @endcan

            </div>
            <div class="bg-white rounded-lg shadow-md p-2 text-center mt-5">
                <h2 class="text-lg font-semibold mb-3">Csapat meccsei</h2>

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Ellenfél
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Időpont
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Eredmény
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($t->games as $g)
                                <tr class="bg-white border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $g->home_team->id == $t->id ? $g->away_team->name : $g->home_team->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ date_format(date_create($g->start), 'Y.m.d H:i') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($g->start < now())
                                            {{ $g->home_team->id == $t->id ? $g->results['home_team'] . " - " . $g->results['away_team'] : $g->results['away_team'] . " - " . $g->results['home_team'] }}
                                        @else
                                            <span class="italic">Jövőbeli</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <td colspan="3" class="text-lg font-bold italic text-center"> Nincsenek meccsek</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-main>
