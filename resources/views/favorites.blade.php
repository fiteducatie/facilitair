<x-guest-layout>
     <div class="m-4 columns-2 md:columns-3 lg:columns-4">
        <div style="background-color: #e5e5f7;

            border-bottom-right-radius: 10px;
            background-image:  radial-gradient(hotpink 1px, transparent 0.5px), radial-gradient(hotpink 1px, #eee 0.5px);
            background-size: 20px 20px;
            background-position: 0 0,10px 10px;" class="info p-4 mb-4  min-h-300">
            <h1 class="text-3xl font-bold">Jouw favorieten</h1>
            <p class="text-gray-500"></p>
        </div>
        @foreach($pins as $pin)
            @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
        @endforeach
    </div>
</x-guest-layout>
