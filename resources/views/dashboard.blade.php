<x-app-layout title="Dashboard">
    {{-- @if (auth()->check() && auth()->user()->isAdmin())
        <p>Welcome, Admin!</p>
    @endif --}}
    <div class="mx-auto sm:px-0 px-3">
        <div class="flex-1 relative">
            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 mr-4">
                                <svg class="w-6 h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                    <path d="M10 9H8" />
                                    <path d="M16 13H8" />
                                    <path d="M16 17H8" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Published Posts</p>
                                <h3 class="text-2xl font-bold">{{ $totalPosts }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 mr-4">
                                <svg class="w-6 h-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8.704 8.704a2.426 2.426 0 0 0 3.42 0l6.58-6.58a2.426 2.426 0 0 0 0-3.42z" />
                                    <circle cx="7.5" cy="7.5" r=".5" fill="currentColor" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Categories</p>
                                <h3 class="text-2xl font-bold">{{ $totalCategories }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 mr-4">
                                <svg class="w-6 h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path
                                        d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Total Likes</p>
                                <h3 class="text-2xl font-bold">{{ $totalLikes }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-4 border-b flex justify-between items-center">
                            <h3 class="text-lg font-semibold">Recent Posts</h3>
                            <a href="{{ route('blogs.index') }}" class="text-blue-600 text-sm hover:underline">View
                                All</a>
                        </div>

                        <div class="p-4">
                            <div class="space-y-4">
                                @foreach ($blogs as $blog)
                                    <div class="border-b pb-3">
                                        <a href="blogs/{{ $blog->id }}">
                                            <div class="flex justify-between mb-1">
                                                <h4 class="font-medium">{{ $blog->title }}</h4>
                                                <span class="text-xs text-gray-500">2 days ago</span>
                                            </div>
                                            <p class="text-sm text-gray-600 mb-1"> {!! Str::limit(strip_tags($blog->content), 80) !!}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>


</x-app-layout>
