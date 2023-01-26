<div class="flex flex-col">
    <label class="block text-gray-700 font-medium mb-2" for="tags">
      Tags
    </label>
    <input type="hidden" name="tags" value="{{implode(',',$chosenTags)}}">
      <div class="flex flex-wrap gap-2 tags-to-add rounded-t-md bg-gray-100 border border-gray-300 placeholder-gray-500 p-4">
        @if($chosenTags)
            @foreach($chosenTags as $tag)
                <span class="mr-4 relative bg-indigo-500 text-white px-2 py-1 rounded-lg animate-wiggle">#{{$tag}}
                    <div wire:click="deleteTag('{{$tag}}')" class="!cursor-pointer hover:scale-110 absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -right-4 dark:border-gray-900">x</div>
                </span>
            @endforeach
        @else
            <span class="italic text-gray-400">Nog geen tags gekozen</span>
        @endif
      </div>
     <div class="relative">

      <input placeholder="Voer tag in" wire:model="search" wire:keyup="searchTag" id="tags" name="" class="!cursor-text form-input py-2 px-3 block w-full leading-5 rounded-b-md transition duration-150 ease-in-out bg-white border-x border-b border-t-transparent border-gray-300 placeholder-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10 sm:text-sm sm:leading-5"">

      <button wire:click="addTag" style="cursor: pointer" type="button" wire:submit.prevent class="absolute inset-y-0 cursor-pointer right-0 pr-3 flex items-center text-gray-500 rounded-md hover:text-blue-600">
        voeg tag toe
      </button>
    </div>

    @if(count($selectedTags))
        <div class="tags mt-2">
        @foreach($selectedTags as $tag)
            <span style="cursor: pointer" wire:click="addTag('{{$tag->name}}')" class="bg-gray-500 text-white px-2 py-1 rounded-lg">#{{$tag->name}}</span>
        @endforeach
        </div>
    @endif
</div>
