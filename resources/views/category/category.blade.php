<x-app-layout title="All category">
    @if (session('success'))
        <x-toasts.success :message="session('success')" />
    @endif
    <div class="flex-1 relative">
        <main class="px-6">
            <div class="flex justify-between items-center mb-6 py-4 px-2 rounded-md bg-white">
                <h2 class="text-2xl font-bold">Categories</h2>
                <a href="{{ route('category.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    New Category
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $index => $category)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 {{ $index % 2 == 0 ? 'bg-blue-50' : 'bg-green-50' }} border-b flex items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                <i data-lucide="code" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $category->user_posts_count }} posts</p>
                            </div>
                            @if ($category->id != 1)
                                <div class="flex space-x-2">
                                    <form action="{{ route('category.edit', $category) }}" method="GET">
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('category.destroy', ['id' => $category->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>
                        <div class="p-4">
                            <p class="text-sm text-gray-600 mb-3">{{ $category->description }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </main>
    </div>



</x-app-layout>
