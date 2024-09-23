
 <div x-data="{hover: false}" @mouseover="hover = true" @mouseout="hover = false" class="relative mb-4 before:content-[''] before:rounded-md before:absolute before:inset-0 before:bg-black before:bg-opacity-20">
    @if($pin->getMedia('main_image')->first() || $pin->getMedia('images')->first())
        <img class="w-full rounded-md min-h-300 object-cover" src="{{$pin->getMedia('main_image')->first() ? $pin->getMedia('main_image')->first()->getUrl()  : $pin->getMedia('images')->first()->getUrl() }}">
    @else
        <img class="w-full rounded-md min-h-300 object-cover" src="https://fakeimg.pl/600x400">
    @endif
    <div x-transition x-show="hover" class="pointer-events-none test__body rounded-md absolute bg-black bg-opacity-50 inset-0 p-8 text-white flex flex-col">
      <div class="relative">
        {{-- show error message --}}
        @if(session()->has('error'))
            <div class="bg-red-500 text-white text-xs p-2 rounded-md">
                {{session('error')}}
            </div>
        @endif
        <div class="actions flex justify-end pointer-events-auto">
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
                  {{-- <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" /> --}}
                    {{-- make a plus sign in svg --}}
                    <path d="M 12 2 C 6.477 2 2 6.477 2 12 C 2 17.523 6.477 22 12 22 C 17.523 22 22 17.523 22 12 C 22 6.477 17.523 2 12 2 z M 12 4 C 16.418 4 20 7.582 20 12 C 20 16.418 16.418 20 12 20 C 7.582 20 4 16.418 4 12 C 4 7.582 7.582 4 12 4 z M 11 6 L 11 11 L 6 11 L 6 13 L 11 13 L 11 18 L 13 18 L 13 13 L 18 13 L 18 11 L 13 11 L 13 6 L 11 6 z" />
                </svg>
            </div>
        </div>
        <div>
            <h1 class="test__title sm:text-2xl md:text-3xl font-bold md:mb-3">{{$pin->title}}</h1>
            <p class="test__author font-sm font-light">{{$pin->user->name}}</p>
            <div class="mt-4">
                {{-- create link button --}}
                <a href="{{route('pin.show', $pin->id)}}" class="pointer-events-auto font-bold test__link bg-pink-400 hover:bg-pink-600 transition duration-75 py-2 px-4 text-black">MEER</a>

            </div>
        </div>

      </div>
         <div class="mt-auto sm:hidden md:block">
            @foreach($pin->tags as $tag)
            <span class="test__tag m-1 my-2 bg-white bg-opacity-60 py-1 px-4 rounded-md text-black"><a class="pointer-events-auto" href="{{route('welcome', ['s' => $tag->name, 'name'=> $tag->name])}}">#{{$tag->name}}</a> </span>
            @endforeach
          </div>
    </div>
</div>
