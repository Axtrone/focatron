<x-main title="Új mérkőzés">
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-2">Új mérkőzés létrehozása</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('games.store') }}" method="POST">
                    @csrf
                    <div class="max-w-xl">
                        <div>
                            <x-input-label for="home_team_id" value="Hazai csapat" class="text-xl" />
                            <select id="home_team_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="home_team_id">
                                @forelse ($teams as $t)
                                    <option {{ old('home_team_id') == $t->id ? "selected" : "" }} value="{{ $t->id }}">{{ $t->name }}</option>
                                @empty
                                    <option value="error">Nincsenek csapatok</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('home_team_id')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <x-input-label for="away_team_id" value="Idegen csapat" class="text-xl" />
                            <select id="away_team_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="away_team_id">
                                @forelse ($teams as $t)
                                    <option {{ old('away_team_id') == $t->id ? "selected" : "" }} value="{{ $t->id }}">{{ $t->name }}</option>
                                @empty
                                    <option value="error">Nincsenek csapatok</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('away_team_id')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <x-input-label for="start" value="Kezdési időpont" class="text-xl" />
                            <x-text-input id="start" class="block mt-1 w-full" type="datetime-local" name="start" :value="old('start', date('Y-m-d H:i'))" autofocus />
                            <x-input-error :messages="$errors->get('start')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <x-primary-button>Létrehozás</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main>
