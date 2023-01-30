<x-guest-layout>
    <div class="md:hidden">
        <x-search-filter />
    </div>
    @if(count($pins) > 1)
     <div class="m-4 columns-2 md:columns-3 lg:columns-4">
    @else
     <div class="m-4 flex w-2/3 items-start gap-4">
    @endif
        <div class="hidden md:block">
            <x-search-filter />
        </div>

        @foreach($pins as $pin)
            @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
        @endforeach
    </div>
</x-guest-layout>
