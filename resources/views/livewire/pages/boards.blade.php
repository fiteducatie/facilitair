<div>
    <div class="m-4">
        <h1 class="text-3xl">Projectborden</h1>
        @foreach($boards as $board)
            <h3 class="text-2xl">{{$board->title}}</h3>
            <p>{{ $board->description }}</p>
            <p> {{$board->pins->count()}} pins </p>
        @endforeach
    </div>
</div>
