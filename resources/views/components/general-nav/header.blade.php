<header class="border-b border-gray-100">
    <div class="container mx-auto px-6 py-6 flex justify-between items-center">
        <a href="{{ route('home') }}">
            <div class="flex items-end space-x-2">
                <div class="h-8 w-8">
                    <img class="object-contain" src="{{ asset('images/logo.png') }}" alt="">
                </div>
                <span class="text-xl font-bold">BLOGX</span>
            </div>
        </a>

        <form class="w-[500px]">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-full bg-gray-50 focus:border-gray-300 active:border-gray-300"
                    placeholder="Search" required />

            </div>
        </form>
        <button id="general-nav-menu-open-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
</header>
