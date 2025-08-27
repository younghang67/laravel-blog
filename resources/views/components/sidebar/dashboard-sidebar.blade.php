<aside id="sidebar" class="sidebar bg-white shadow-md h-dvh min-w-60">
    <nav class="mt-6">
        <a href="{{ route('dashboard') }}" class="py-3 px-4 text-gray-700 hover:bg-gray-100">
            Dashboard
        </a>
        <div class="side-nav-item px-4 hover:bg-gray-100">
            <a href="{{ route('blogs.index') }}" class="py-3 text-gray-700">
                Posts
            </a>
            <ul class="side-nav-hover-item bg-white">
                <li>
                    <a class="py-3 px-4 text-gray-700 hover:bg-gray-100 active" href="{{ route('blogs.index') }}">All
                        Blog</a>
                </li>
                <li>
                    <a class="py-3 px-4 text-gray-700 hover:bg-gray-100 active" href="{{ route('blogs.create') }}">Add
                        New Blog</a>
                </li>
            </ul>
        </div>
        @auth
            @if (auth()->check() && auth()->user()->isAdmin())
                <div class="side-nav-item px-4 hover:bg-gray-100">
                    <a href="{{ route('category.index') }}" class="py-3 text-gray-700">
                        Categories
                    </a>
                    <ul class="side-nav-hover-item bg-white">
                        <li>
                            <a class="py-3 px-4 text-gray-700 hover:bg-gray-100 active"
                                href="{{ route('category.index') }}">All
                                Category</a>
                        </li>
                        <li>
                            <a class="py-3 px-4 text-gray-700 hover:bg-gray-100 active"
                                href="{{ route('category.create') }}">Add
                                New Category</a>
                        </li>
                    </ul>
                </div>
            @endif
        @endauth
        <a href="{{ route('home') }}" class="py-3 px-4 text-gray-700 hover:bg-gray-100">
            Back to site
        </a>
    </nav>
</aside>
