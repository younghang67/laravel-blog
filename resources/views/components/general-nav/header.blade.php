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
        <nav class="hidden md:flex items-center space-x-10 text-gray-600">
            <a href="{{ route('blogs.archive', ['category' => 'technology']) }}"
                class="hover:text-accent transition-colors">Technology</a>
            <a href="{{ route('blogs.archive', ['category' => 'travel']) }}"
                class="hover:text-accent transition-colors">Travel</a>
            <a href="{{ route('blogs.archive', ['category' => 'food']) }}"
                class="hover:text-accent transition-colors">Food</a>
            <a href="{{ route('blogs.archive', ['category' => 'entertainment']) }}"
                class="hover:text-accent transition-colors">Entertainment</a>
            <a href="{{ route('blogs.archive', ['category' => 'health-fitness']) }}"
                class="hover:text-accent transition-colors">Health</a>
            <div>
                @if (Route::has('login'))
                    <nav class="flex items-center justify-end font-semibold gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white bg-accent px-9 py-2 rounded-md">
                                Dashboard
                            </a>
                        @endauth
                    </nav>
                @endif

            </div>
        </nav>
        <div class="md:hidden">
            <div class="space-y-1.5 cursor-pointer">
                <span class="block w-6 h-0.5 bg-gray-600"></span>
                <span class="block w-6 h-0.5 bg-gray-600"></span>
                <span class="block w-6 h-0.5 bg-gray-600"></span>
            </div>
        </div>
    </div>
</header>
