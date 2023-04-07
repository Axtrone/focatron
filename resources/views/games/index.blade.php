<x-main title="Mérkőzések">
<div class="max-w-xl mx-auto">
    <div id="current" class="border-2 border-red-600  mx-0.5 rounded-lg relative">
        <h2 class="absolute left-5 -top-4 px-1 bg-white text-red-600 font-semibold italic">Aktuális</h2>
        @foreach ([1,2] as $a)
            <a href="#" class="my-4 p-3 mx-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex flex-row gap-2">
                <div class="basis-2/5 text-center px-2">
                    <img class="rounded-lg h-16 w-18 mx-auto object-cover" src="https://via.placeholder.com/840x480.png/?text=Logo" alt="Logo">
                    <h4 class="mt-1 font-bold font-mono">Ferencváros</h4>
                </div>
                <div class="basis-1/5 text-center flex flex-col justify-between">
                    <p class="text-2xl font-bold italic font-serif">VS</p>
                        <span class="flex items-center justify-center text-sm font-medium text-gray-900 relative">
                        <span class="relative flex h-3 w-3 mr-1">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>Élő</span>
                    <p class="">2023.04.07</p>
                    <p class="font-bold align-bottom">16:00</p>
                </div>
                <div class="basis-2/5 text-center px-2">
                    <img class="rounded-lg h-16 w-18 mx-auto object-cover" src="https://via.placeholder.com/840x480.png/?text=Logo" alt="Logo">
                    <h4 class="mt-1 font-bold font-mono">Újpest</h4>
                </div>
            </a>
        @endforeach
    </div>
    <div>
        <h2>További meccsek</h2>
        <a href="#" class="my-4 p-3 mx-1 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 flex flex-row gap-2">
            <div class="basis-2/5 text-center px-2">
                <img class="rounded-lg h-16 w-18 mx-auto object-cover" src="https://via.placeholder.com/840x480.png/?text=Logo" alt="Logo">
                <h4 class="mt-1 font-bold font-mono">Ferencváros</h4>
            </div>
            <div class="basis-1/5 text-center flex flex-col justify-between">
                <p class="text-2xl font-bold italic font-serif">VS</p>
                <p class="">2023.04.07</p>
                <p class="font-bold align-bottom">16:00</p>
            </div>
            <div class="basis-2/5 text-center px-2">
                <img class="rounded-lg h-16 w-18 mx-auto object-cover" src="https://via.placeholder.com/840x480.png/?text=Logo" alt="Logo">
                <h4 class="mt-1 font-bold font-mono">Újpest</h4>
            </div>
        </a>
    </div>
</div>
</x-main>
