<div>
    <div class="m-4">
        <h1 class="text-3xl mb-4">Projectborden</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($boards as $board)
                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition p-4">
                    <a href="{{ route('board.show', $board->id) }}" class="block">
                        <h3 class="text-xl font-bold text-blue-600 hover:underline mb-2">{{$board->title}}</h3>
                        <p class="text-gray-600 mb-4">{{ $board->description }}</p>
                        <p class="text-sm text-gray-500"> {{$board->pins->count()}} pins </p>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</div>
