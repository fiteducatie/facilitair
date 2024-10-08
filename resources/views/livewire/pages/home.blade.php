<div>
<div class="grid md:grid-cols-2">

    <x-search-filter />
    <div class="p-4 m-4 hidden sm:block">
        <img style="width: 200px" class="mb-4" src="{{asset('img/logo.svg')}}" alt="">
        <p>Welkom bij onze inspiratiehub 'Spaces', waar de creatieve inzet van ruimtes in het onderwijs centraal staat.
            Verken inspirerende indelingen, efficiënte planningen en vernieuwende ideeën van collega's door het land.
            Deze hub biedt een unieke kans om te leren van elkaar en samen onze ruimtes optimaal in te zetten.</p>
            <p><b>Instructie video</b></p>
            <iframe allowfullscreen src="https://feddmanspace.ams3.digitaloceanspaces.com/Facilitair/instructie_facilitair_app.mp4" frameborder="0"></iframe>
    </div>
</div>
@if(count($pins) > 2)
 <div class="m-4 columns-2 md:columns-3 lg:columns-4">
@else
 <div class="m-4 flex w-2/3 items-start gap-4">
@endif

        @forelse($pins as $pin)
            @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
        @empty

    <div class="bg-indigo-500  text-white p-4 rounded-lg">
      <p class="font-medium">Helaas!</p>
      <p class="text-sm">Geen pins gevonden...</p>
    </div>
    @endforelse


</div>
<div class="m-4">
    {{$pins->links()}}
</div>

@if($projectModalActive)
{{-- modal --}}
<div id="myModal" class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 text-center">
      <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

      <!-- Modal Content -->
      <div class="z-10 inline-block w-full max-w-lg p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Toevoegen aan projectbord:</h3>
        <div class="mt-2">
            <select wire:change="setBoard($event.target.value)" name="board" id="board" class="block w-full px-4 py-2 mt-1 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Maak een keuze</option>
                @foreach(auth()->user()->boards as $board)
                    <option  value="{{ $board->id }}">{{ $board->title }}</option>
                @endforeach
            </select>

        </div>
        <div class="mt-4">
          <button wire:click="closeModal" id="closeModal" class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600">
            Annuleren
          </button>
          <button wire:click="addToProject" id="addToProject" class="px-4 py-2 text-sm font-semibold text-white bg-green-500 rounded hover:bg-green-600">
            Toevoegen
          </button>
        </div>
      </div>
    </div>
  </div>


@endif
</div>
