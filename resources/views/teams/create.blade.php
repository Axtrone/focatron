<x-main title="Új csapat">
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-2">Új csapat létrehozása</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="max-w-xl">
                        <div class="mt-6">
                            <x-input-label for="name" value="Csapatnév" class="text-xl" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <x-input-label for="shortname" value="Rövid név" class="text-xl" />
                            <x-text-input id="shortname" class="block mt-1 w-full" type="text" name="shortname" :value="old('shortname')" autofocus />
                            <x-input-error :messages="$errors->get('shortname')" class="mt-2" />
                        </div>
                        <div class="mt-6">
                            <x-input-label for="image" value="Logó" class="text-xl" />
                            <x-text-input id="image" class="block mt-1 w-full border" type="file" name="image" :value="old('image')" autofocus />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
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
