<div>
    <h1 class="text-3xl m-4">Pins van projectbord: {{$board->title}}</h1>
    <p class="m-4"><i>Projectbord van: {{ $board->user->name }}</i></p>
    <a class="m-4 p-2 bg-green-500 font-bold" href="/app/boards/{{$board->id}}/edit" class="">Board Beheren</a>
    <div class="m-4 columns-2 md:columns-3 lg:columns-4">

        @foreach($board->pins as $pin)
                @livewire('pins.card', ['pin' => $pin, 'fromBoard' => true], key($pin->id . '-card'))
        @endforeach
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
    {{-- The best athlete wants his opponent at his best. --}}
</div>
