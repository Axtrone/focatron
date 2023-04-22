<x-main title="Csapat módosítás">
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-2">Csapat módosítása</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('teams.update', ['team' => $t]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="max-w-xl">
                        <div class="mt-6">
                            <x-input-label for="name" value="Csapatnév" class="text-xl" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $t->name)" autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <x-input-label for="shortname" value="Rövid név" class="text-xl" />
                            <x-text-input id="shortname" class="block mt-1 w-full" type="text" name="shortname" :value="old('shortname', $t->shortname)" autofocus />
                            <x-input-error :messages="$errors->get('shortname')" class="mt-2" />
                        </div>
                        @if ($t->image !== null)
                        <div class="mt-6">
                            <x-input-label for="image" value="Logó módosítás" class="text-xl" />
                            <img class="rounded-lg h-36 mx-auto mb-2 object-cover" src="{{ Storage::url('logos/'. $t->image) }}" alt="Logo">
                            <x-text-input id="image" class="block mt-1 w-full border" type="file" name="image" :value="old('image', $t->image)" autofocus />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        @else
                        <div class="mt-6">
                            <x-input-label for="image" value="Logó" class="text-xl" />
                            <x-text-input id="image" class="block mt-1 w-full border" type="file" name="image" :value="old('image')" autofocus />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                        @endif
                        <div class="mt-6">
                            <x-primary-button>Módosítás</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main>
