<x-general-layout title="{{ $blog->title }}">
    @if (session('success'))
        <x-toasts.success :message="session('success')" />
    @endif
    <main class="bg-white font-sans text-gray-800 antialiased">
        <section class="py-12 md:py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <div class="flex items-center mb-4">
                        <a href="#"
                            class="text-xs font-medium text-accent uppercase tracking-wider hover:underline">{{ $blog->category->name }}</a>
                        <span class="mx-2 text-gray-300">•</span>
                        <span
                            class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6">{{ $blog->title }}</h1>
                    <div class="flex items-center">
                        <div>
                            <div class="flex items-center">
                                <p class="font-medium">{{ $blog->user->name }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Image -->
        <section class="py-8">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <img src="{{ $blog->image_url ? $blog->image_url : '/images/placeholder-image.png' }}"
                        alt="Featured image" class="w-full h-auto max-h-[500px] object-cover rounded-lg shadow-md">
                </div>
            </div>
        </section>

        {{-- Article Content  --}}
        <section class="py-8">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto">
                    <!-- Article Text -->
                    <article class="prose">
                        {!! $blog->content !!}
                    </article>
                </div>
            </div>
        </section>

        {{-- likes  --}}
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">
                <div class="flex items-center gap-2 mt-4">
                    <form action="{{ route('posts.like', $blog) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-1 text-{{ $blog->isLikedBy(auth()->user()) ? 'red-500' : 'gray-500' }} hover:text-red-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                fill="{{ $blog->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span>{{ $blog->likes->count() }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Articles -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto">
                    <h2 class="text-2xl font-bold mb-8">Related Articles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                        @if (sizeof($relatedPosts))
                            @foreach ($relatedPosts as $relatedPost)
                                <article
                                    class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                                    <img src="{{ $relatedPost->image_url ? $relatedPost->image_url : '/images/placeholder-image.png' }}"
                                        alt="Blog post" class="w-full h-48 object-cover">
                                    <div class="p-6">
                                        <div class="flex flex-wrap items-center mb-2">
                                            <span
                                                class="text-xs font-medium text-accent uppercase tracking-wider">{{ $relatedPost->category->name }}</span>
                                            <span class="mx-2 text-gray-300">•</span>
                                            <span
                                                class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($relatedPost->created_at)->format('d F, Y') }}</span>
                                        </div>
                                        <h3 class="text-xl font-bold mb-2">{{ $relatedPost->title }}</h3>
                                        <div class="text-gray-600 mb-4">
                                            {!! Str::limit(strip_tags($relatedPost->content), 40) !!}
                                        </div>
                                        <a href="{{ route('blogs.single', $relatedPost) }}"
                                            class="text-accent font-medium hover:underline">Read more</a>
                                    </div>
                                </article>
                            @endforeach
                        @else
                            <p>Sorry No Related posts to show</p>
                        @endif


                    </div>
                </div>
            </div>
        </section>

        <x-shared.commentSection :blog="$blog" :comments="$blog->comments" :totalComments="$totalComments" />

    </main>
</x-general-layout>
