<x-guest-layout>
     <div class="m-4 columns-2 md:columns-3 lg:columns-4">
        <div class="info p-4 column min-h-300" style="background-color: #e5e5f7;

            border-bottom-right-radius: 10px;
            background-image:  radial-gradient(hotpink 1px, transparent 0.5px), radial-gradient(hotpink 1px, #eee 0.5px);
            background-size: 20px 20px;
            background-position: 0 0,10px 10px;" >
            <div>
                  <h1 class="text-3xl font-bold">Home</h1>
                  <div class="relative items-center">
                    <div>
                        <input @click="showJumbo =! showJumbo" type="text" name="search" class="bg-gray-100 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-pink-400" placeholder="Search">
                        <p class="font-bold">Laatste tags:</p>
                        <div class="tags flex flex-wrap gap-2">
                            @foreach(Spatie\Tags\Tag::latest()->take(5)->get() as $tag)
                                <a href="" class="bg-gray-500 text-white px-2 py-1 rounded-lg mt-2">#{{$tag->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="font-bold mt-4">
                     Zoeken op categorie:
                    <select  offset={-50} class="bg-gray-100 appearance-none border-2 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-pink-400" name="" id="">
                        <option value="">Selecteer categorie</option>
                        @foreach(\App\Models\Category::getParents() as $category)
                            <optgroup label="{{$category->name}}">
                                @foreach($category->subcategories as $sub)
                                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        @foreach($pins as $pin)
            @livewire('pins.card', ['pin' => $pin], key($pin->id . '-card'))
        @endforeach
    </div>
</x-guest-layout>
