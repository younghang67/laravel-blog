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
        <button id="general-nav-menu-open-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </div>
</header>
