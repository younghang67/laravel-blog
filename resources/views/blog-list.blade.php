<x-general-layout>
    <section class="container mx-auto px-4 py-8">
        <form class="flex flex-wrap flex-col gap-4" action="{{ route('blog.all.list') }}" method="GET">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                        Category</label>
                    <select id="category" name="category"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                    <select id="sort" name="sort"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Newest
                            First</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    </select>
                </div>
            </div>
            <div class="flex flex-wrap gap-4 items-end">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input id="search"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" name="search" placeholder="Search title..." value="{{ request('search') }}">
                </div>
                <div class="flex gap-4">
                    <button class="px-6 py-2 bg-accent hover:bg-accentHover text-white rounded-lg transition-colors"
                        type="submit">Filter</button>
                    @if (request()->anyFilled(['category', 'search', 'sort']))
                        <a href="{{ route('blog.all.list') }}"
                            class="px-6 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </section>
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blogs as $blog)
                    <article
                        class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                        <a href="{{ route('blogs.single', $blog) }}">
                            <img src="{{ $blog->image_url ? $blog->image_url : '/images/placeholder-image.png' }}" alt="Blog post" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <span
                                        class="text-xs font-medium text-accent uppercase tracking-wider">{{ $blog->category->name }}</span>
                                    <span class="mx-2 text-gray-300">•</span>
                                    <span
                                        class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold mb-2">{{ $blog->title }}</h3>
                                <p class="text-gray-600 mb-4"> {!! Str::limit(strip_tags($blog->content), 80) !!}</p>
                                <div class="flex items-center">
                                    <div>
                                        <p class="font-medium text-sm">{{ $blog->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
            <div class="pagination mt-8 mb-5 px-3">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
</x-general-layout>
