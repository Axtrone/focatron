<x-main title="Kedvencek">
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-3">Kedvenceim</h1>
    <div class="md:flex md:flex-row md:gap-5 justify-center">
        <div class="bg-white rounded-lg shadow-md p-2 text-center mt-5">
            <h2 class="text-xl font-semibold mb-3 mx-5">Kedvenc csapatok</h2>
            <ul class="max-w-md space-y-1 list-inside mx-3 text-lg">
                @foreach ($teams as $t)
                <li class="flex items-center">
                    <x-fav-button team="{{ $t->id }}" class="me-2" />
                    {{ $t->name }}
                </li>
                @endforeach
            </ul>
        </div>
        <div class="bg-white rounded-lg shadow-md p-2 text-center mt-5">
            <h2 class="text-xl font-semibold mb-3">Kedvencek meccsei</h2>
            <div class="relative overflow-x-auto sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Csapatok
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
                        @forelse ($games as $g)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                    {{ $g->home_team->name . ' - ' . $g->away_team->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ date_format(date_create($g->start), 'Y.m.d H:i') }}
                                </td>
                                <td class="text-center">
                                    @if ($g->start < now())
                                        {{$g->results['home_team'] . " - " . $g->results['away_team'] }}
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
                <div class="mt-2">
                    {{ $games->links() }}
                </div>
            </div>
        </div>
    </div>
</x-main>
