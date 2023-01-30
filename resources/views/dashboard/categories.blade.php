 {{--layout app  --}}
<x-app-layout>
            <div class="flex justify-between py-4">
                <h1 class="text-2xl font-medium mb-4">Categorieën

                </h1>


            </div>
            <div class="grid md:grid-cols-2 gap-4">
                @foreach($categories as $category)
                    <div class="bg-gray-200 p-4 rounded-lg">
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium mb-2">
                                <a href="{{route('categories.edit', $category->id)}}">{{ $category->name }}</a>
                                <span class="text-xs bg-blue-500 text-white px-2 rounded-full">{{ $category->pins->count() }} pins</span>
                            </h2>

                            <form method="post" action="{{route('categories.destroy', $category)}}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="X" class="cursor-pointer bg-red-500 p-2">
                            </form>
                        </div>

                        {{-- list subcategories --}}
                        <div class="subcategories">
                            <p class="font-bold">Subcategorieën</p>
                             <ul class="pl-4">
                              @forelse($category->subcategories as $sub)
                                <li><a href="{{route('categories.edit', $sub->id)}}">{{$sub->name}}</a></li>
                              @empty
                                <li class="text-red-500">Geen subcategorieën</li>
                              @endforelse
                            </ul>

                        </div>

                    </div>
                @endforeach
            </div>
            <div class="md:w-1/2">
                {{-- new category form --}}
                <form action="{{route('categories.store')}}" method="POST" class="mt-4">
                    @csrf
                    <h2 class="text-lg font-medium mb-2">Nieuwe categorie</h2>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="name">
                          Categorie naam
                        </label>
                        <input class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="name" name="name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="description">
                          Categorie beschrijving
                        </label>
                        <textarea class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2" for="parent">
                          Subcategorie van: (optioneel)
                        </label>
                        <select class="border border-gray-400 p-2 rounded-lg w-full" type="text" id="parent" name="parent_category_id">
                            <option value="">Kies een eventuele hoofd categorie</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                    <button type="submit" class="mt-4 bg-indigo-500 text-white p-2 rounded-lg hover:bg-indigo-600">Opslaan</button>
                </form>
            </div>
</x-app-layout>
