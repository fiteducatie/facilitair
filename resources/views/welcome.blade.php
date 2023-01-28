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

        @forelse($pins as $pin)
            @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
        @empty
        <div class="bg-indigo-500  text-white p-4 rounded-lg">
          <p class="font-medium">Helaas!</p>
          <p class="text-sm">Geen pins gevonden...</p>
        </div>
        @endforelse
    </div>
</x-guest-layout>
