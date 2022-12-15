 <div x-data="{hover: false}" @mouseover="hover = true" @mouseout="hover = false" class="relative mb-4 before:content-[''] before:rounded-md before:absolute before:inset-0 before:bg-black before:bg-opacity-20">
    <img class="w-full rounded-md" src="https://source.unsplash.com/random/1">
    <div x-transition x-show="hover" class="pointer-events-none test__body rounded-md absolute bg-black bg-opacity-50 inset-0 p-8 text-white flex flex-col">
      <div class="relative">
        <div class="actions flex justify-end pointer-events-auto">
            <div wire:click="toggleLike" class="action-like cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
            </div>
            <div wire:click="toggleSave" class="action-save cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
            </div>
        </div>
        <h1 class="test__title text-3xl font-bold mb-3">Title post</h1>
        <p class="test__author font-sm font-light">Author</p>
      </div>
      <div class="mt-auto">
        <span class="test__tag bg-white bg-opacity-60 py-1 px-4 rounded-md text-black">#tag</span>
      </div>
    </div>
  </div>
