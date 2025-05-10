<x-app-layout title="Dashboard">
    <div class="mx-auto sm:px-0 px-3">
        <div class="flex-1 relative">
            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 mr-4">
                                <i data-lucide="file-text" class="w-6 h-6 text-blue-600"></i>
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
                                <i data-lucide="tag" class="w-6 h-6 text-yellow-600"></i>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Categories</p>
                                <h3 class="text-2xl font-bold">{{ $totalCategories }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 mr-4">
                                <i data-lucide="tag" class="w-6 h-6 text-yellow-600"></i>
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
