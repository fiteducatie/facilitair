  {{-- navbar --}}
<div x-data="{showJumbo: false}" class="nav-jumbo">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{route('welcome')}}">
                            <h2 class="text-2xl font-bold">Facilitair</h2>
                        </a>
                    </div>
                    <div class="sm:-my-px sm:ml-6 sm:flex sm:space-x-8 flex items-center">
                        <a href="{{route('welcome')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                            Home
                        </a>
                        <a href="{{route('pin.index')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            Mijn Pins
                        </a>
                        <a href="{{route('pin.create')}}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            + Nieuw
                        </a>
                        {{-- search field --}}
                        <div class="relative items-center">
                            <div>
                                <input @click="showJumbo =! showJumbo" type="text" name="search" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-64 py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" placeholder="Search">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <button class="p-1 border"></button>
                </div>
            </div>
        </div>
    </nav>
    {{-- <div

    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    @click.outside="showJumbo = false" x-show="showJumbo" class="jumbo absolute top-15 w-full z-40 ">
        <div class="bg-white p-20 mx-auto flex w-3/4">
            <div>
                <div class="flex justify-between w-full">
                    <div class="category p-10 bg-pink-200 rounded">Categorie 1</div>
                    <div class="category p-10 bg-pink-200 rounded">Categorie 2</div>
                    <div class="category p-10 bg-pink-200 rounded">Categorie 3</div>
                    <div class="category p-10 bg-pink-200 rounded">Categorie 4</div>
                    <div class="category p-10 bg-pink-200 rounded">Categorie 5</div>
                </div>

                <div class="badge-list">
                    <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Default</span>
                    <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Dark</span>
                    <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Red</span>
                    <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Green</span>
                    <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">Yellow</span>
                    <span class="bg-indigo-100 text-indigo-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-indigo-200 dark:text-indigo-900">Indigo</span>
                    <span class="bg-purple-100 text-purple-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-purple-200 dark:text-purple-900">Purple</span>
                    <span class="bg-pink-100 text-pink-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-200 dark:text-pink-900">Pink</span>
                </div>
            </div>
        </div>
 --}}

    {{-- </div> --}}
</div>
