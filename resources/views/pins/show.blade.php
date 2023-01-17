<x-guest-layout>
    <div class="mt-4 flex justify-center ">
        <div class="md:w-3/4 md:flex flex-row">
            <img class="md:w-1/2" src="https://source.unsplash.com/random/{{$pin->id}}" alt="">
            <div class="md:w-1/2 p-4 shadow-inner">
                <h1 class="text-2xl font-bold">{{$pin->title}}</h1>
                <p class="text-sm">Geupload door: <b>{{$pin->user->name}}</b></p>
                <p class="text-sm">{{$pin->description}}</p>

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
    </div>
</x-guest-layout>
