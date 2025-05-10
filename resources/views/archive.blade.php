<x-general-layout title="{{ $category?->name }}">
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="mb-8">
                <h2>
                    {{ $category?->name ?? 'All Categories' }}
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($blogs as $blog)
                    <article
                        class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                        <a href="{{ route('blogs.single', $blog) }}">
                            <img src="{{ $blog->image_url }}" alt="Blog post" class="w-full h-48 object-cover">
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
