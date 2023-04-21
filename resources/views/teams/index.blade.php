<x-main title="Csapatok">
    <h1 class="text-2xl md:text-3xl font-bold text-center mb-3">Csapatok</h1>

    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col mx-1 bg-white rounded-lg shadow">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                  <table class="min-w-full text-left text-sm font-light">
                    <thead class="border-b font-medium">
                      <tr class="text-center">
                        <th scope="col" class="px-6 py-4 md:text-lg">Logó</th>
                        <th scope="col" class="px-6 py-4 md:text-lg">Név</th>
                        <th scope="col" class="px-6 py-4 md:text-lg">Részletek</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($teams as $t)
                      <tr class="border-b my-3">
                        <td>
                            <img class="rounded-lg h-16 w-18 mx-auto object-cover" src="{{ $t->image ? $t->image : "https://via.placeholder.com/840x480.png/?text=Logo" }}" alt="Logo">
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 flex flex-col text-center">
                            <p class="font-bold font-mono text md:text-xl">{{ $t->name }}</p>
                            <p class="font-semibold font-mono italic md:text-lg">{{ $t->shortname }}</p>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="flex flex-col items-center justify-center">
                                <a href="{{ route('teams.show', ['team' => $t]) }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</x-main>
