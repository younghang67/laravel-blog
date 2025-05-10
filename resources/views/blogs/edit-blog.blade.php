<x-app-layout class="Edit blog">
    <div>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-xl w-full mx-4">
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-xl font-bold"> Edit Post</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('blogs.update', $post) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex justify-between gap-4">
                        <div class="mb-4 flex-1 flex flex-col gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Post Title</label>
                                <input type="text"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Enter post title" name="title"
                                    value="{{ old('title', $post->title) }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                                <textarea id="content" name="content" placeholder="Write your post content here..."
                                    class="ckeditor w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 h-40"
                                    required>{!! old('content', $post->content) !!}</textarea>
                                <script>
                                    CKEDITOR.replace('content');
                                </script>
                            </div>
                        </div>
                        <div>
                            <div class="flex flex-col gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select
                                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select
                                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        name="status">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ $post->status == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                                <div x-data="{ file: null, preview: '{{ $post->image_url ? asset($post->image_url) : '' }}' }"
                                    class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <div class="flex justify-center">
                                        <template x-if="preview">
                                            <img :src="preview" alt="Image Preview"
                                                class="mt-2 w-40 h-auto object-contain rounded">
                                        </template>
                                    </div>
                                    <p x-show="!preview" class="text-sm text-gray-500">click to select a file</p>
                                    <button
                                        class="mt-2 inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        @click.prevent="$refs.fileInput.click()">Select Image</button>

                                    <input type="file" x-ref="fileInput" class="hidden" id="image_url"
                                        name="image_url"
                                        @change="let reader = new FileReader(); reader.onload = (e) => preview = e.target.result; file = $event.target.files[0]?.name; reader.readAsDataURL($event.target.files[0]);">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('blogs.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Save Post
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
