 {{--layout app  --}}
<x-app-layout>
            <a href="{{route('dashboard.categories')}}" class="p-4 bg-blue-500">Terug</a>
            <div class="flex justify-between py-4">
                <h1 class="text-2xl font-medium mb-4">Categorieën wijzigen
                </h1>
            </div>
            <div class="">
                <form action="{{route('categories.update', $category->id)}}" method="post">
                    @csrf
                    @method('put')
                    <input type="text" value="{{$category->name}}" name="name">
                    <input type="submit" class="p-2 bg-blue-500" value="Wijzigen">
                </form>

                <form action="{{route('categories.destroy', $category->id)}}" method="post" class="mt-2">
                    @csrf
                    @method('delete')
                    <input class="p-2 bg-red-500" type="submit" value="verwijderen">
                </form>
            </div>
</x-app-layout>
