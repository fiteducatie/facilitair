<x-guest-layout>

     <div class="m-4 columns-2 md:columns-3 lg:columns-4">

        @foreach($pins as $pin)
            @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
        @endforeach
    </div>
</x-guest-layout>
