<div class="flex gap-4">
    @foreach ($categories as $category)
        <button class="category-btn" data-id="{{ $category->id }}">
            {{ $category->name }}
        </button>
    @endforeach
</div>

<div id="posts-container" class="grid grid-cols-3 gap-6 mt-6">
    @foreach ($blogs as $blog)
        <div class="p-4 bg-white shadow rounded">
            <h2>{{ $blog->title }}</h2>
            <p>{{ $blog->user->name }}</p>
        </div>
    @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.querySelectorAll('.category-btn').forEach(button => {
        button.addEventListener('click', function() {
            let categoryId = this.getAttribute('data-id');

            axios.get("{{ route('fetch.posts') }}", {
                    params: {
                        category: categoryId
                    }
                })
                .then(response => {
                    let posts = response.data.data;
                    let html = '';

                    if (posts.length > 0) {
                        posts.forEach(post => {
                            html += `
                        <div class="p-4 bg-white shadow rounded">
                            <h2>${post.title}</h2>
                            <p>${post.user.name}</p>
                        </div>
                    `;
                        });
                    } else {
                        html = "<p>No posts found for this category.</p>";
                    }

                    document.getElementById('posts-container').innerHTML = html;
                })
                .catch(error => console.error(error));
        });
    });
</script>
