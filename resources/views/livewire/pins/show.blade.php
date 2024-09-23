<div class="mt-4 flex justify-center min-h-screen" >
    <div class="md:w-3/4  gap-4 md:flex flex-row m-4">
        <div x-data="{
            activeImage: '@if($pin->getMedia('main_image')->first()) {{$pin->getMedia('main_image')->first()->getUrl()}} @elseif($pin->getMedia('images')->first()) {{$pin->getMedia('images')->first()->getUrl()}} @else https://fakeimg.pl/600x400 @endif',

        }" class="md:w-1/2">
            <img class="w-full" :src="activeImage" alt="">
            <div class="carousel">
                <div class="flex flex-wrap">
                    @if($pin->getMedia('main_image')->first())
                        <div class="w-1/4 p-2">
                            <img class="cursor-pointer" @click="activeImage = `{{$pin->getMedia('main_image')->first()->getUrl()}}`" class="w-full" src="{{$pin->getMedia('main_image')->first()->getUrl()}}" alt="">
                        </div>
                    @endif
                    @foreach($pin->getMedia('images') as $image)
                        <div class="w-1/4 p-2">
                            <img class="cursor-pointer" @click="activeImage = `{{$image->getUrl()}}`" class="w-full" src="{{$image->getUrl()}}" alt="">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <div style="
                background: rgba(0, 0, 0, 0.22);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);
        " class="md:w-1/2 p-4 shadow-inner">
          <div class="flex justify-between">
            <h1 class="text-2xl font-bold">{{$pin->title}}</h1>
            <div x-data="{open: false, confirmDelete: false}" @click.away="open = false" class="relative">
              <button @click="open =! open" class="text-gray-500 hover:text-gray-600">
                <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                </svg>
              </button>
              <div x-show="open" class="absolute right-0 z-10 w-72 bg-white rounded-md shadow-md mt-1 py-1">

                @auth
                    @if($pin->user_id == Auth::id() || Auth::user()->hasRole('admin'))
                    <a href="{{route('filament.app.resources.pins.edit', $pin->id)}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-500 hover:text-white">Wijzigen</a>

                    @endif
                @endauth
              </div>
            </div>
        </div>
        <div class="actions flex justify-start pointer-events-auto">
            <div wire:click="toggleLike" class="action-like cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="@if($pin->likedByUser()) hotpink @else white @endif" viewBox="0 0 24 24" stroke-width="0" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </div>
            <div wire:click="toggleSave" class="ml-2 action-save cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="@if($pin->savedByUser()) hotpink @else white @endif" viewBox="0 0 24 24" stroke-width="0" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
            </div>
            <div wire:click="toggleProject" class="ml-2 action-save cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="0" stroke="currentColor" class="w-6 h-6">
                    <path d="M 12 2 C 6.477 2 2 6.477 2 12 C 2 17.523 6.477 22 12 22 C 17.523 22 22 17.523 22 12 C 22 6.477 17.523 2 12 2 z M 12 4 C 16.418 4 20 7.582 20 12 C 20 16.418 16.418 20 12 20 C 7.582 20 4 16.418 4 12 C 4 7.582 7.582 4 12 4 z M 11 6 L 11 11 L 6 11 L 6 13 L 11 13 L 11 18 L 13 18 L 13 13 L 18 13 L 18 11 L 13 11 L 13 6 L 11 6 z" />
                </svg>
            </div>
        </div>
            <div class="pin-info">
                <p class="text-sm">Geupload door: <b>{{$pin->user->name}}</b></p>
                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Korte beschrijving</h4>
                    <p class="font-roboto text-gray-600">{{$pin->description}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">School</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->school_name ?? ''}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Locatie in schoolgebouw</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->school_location ?? ''}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Datum gebruikname</h4>
                    <p class="font-roboto text-gray-600">@if($pin->pinMeta){{Date('d-m-Y', strtotime($pin->pinMeta->datum_gebruikname)) ?? ''}} @endif</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Waarom deze pin</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->reden_bijzonderheid ?? ''}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Wat gebruikers er over zeggen</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->meningen ?? ''}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Waar wordt het voornamelijk voor gebruikt?</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->primair_doel ?? ''}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Overige bijzonderheden?</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->bijzonderheden ?? ''}}</p>
                </div>

                <div class="mt-2 description">
                    <h4 class="text-lg font-bold">Betrokken partijen</h4>
                    <p class="font-roboto text-gray-600">{{$pin->pinMeta->betrokkenen ?? ''}}</p>
                </div>
            </div>
            <div class="meta">
                <div class="likes">
                    <p>
                        @for($i = 0; $i < $pin->likes->count(); $i++)
                            <x-icon.heart :pin="$pin"></x-icon.heart>
                        @endfor
                        ({{$pin->likes->count()}} likes)
                    </p>
                </div>

            </div>
        </div>
    </div>

    @if($modalBoardActive)
    <div class="modal">
        <button @click="saveToBoard()" >Add to projectboard</button>
    </div>
    @endif


@if($modalBoardActive)
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
