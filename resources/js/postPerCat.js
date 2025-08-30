import $ from "jquery";

$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});

$(document).ready(function () {
  // 🔹 Reusable function to load posts
  function loadPosts(categoryId) {
    $.ajax({
      url: "/posts-per-category",
      type: "POST",
      data: { category_id: categoryId },
      success: function (response) {
        const postsContainer = $("#postsContainer");
        postsContainer.empty();

        if (response.posts.length > 0) {
          $.each(response.posts, function (index, post) {
            console.log("Post Object:", post);
            postsContainer.append(`
              <a href="/blogs/${post.slug}"
                class="overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="p-0">
                    <div class="relative aspect-video overflow-hidden">
                        <img src="${post.image_url ? post.image_url : "/images/placeholder-image.png"}"
                            alt="post_image"
                            class="hover:scale-105 transition-transform duration-300 w-full h-[250px] object-cover" />
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="bg-gray-200 text-xs px-2 py-1 rounded">
                            ${post.category.name}
                        </span>
                        <time class="text-sm text-gray-500">
                            ${
                              post.created_at
                                ? new Date(post.created_at.replace(" ", "T")).toLocaleDateString("en-US", {
                                    month: "short",
                                    day: "numeric",
                                    year: "numeric",
                                  })
                                : ""
                            }
                        </time>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-900 mb-2 leading-tight">
                        ${post.title}
                    </h3>

                    <div class="text-gray-500 text-sm leading-relaxed nostyle-excerpt">
                    ${post.content.substring(0, 100)}...
                    </div>
                </div>
                <div class="px-6 pb-6 pt-0">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span>
                        </div>
                        <span class="text-sm text-gray-500">
                            ${post.user.name}
                        </span>
                    </div>
                </div>
              </a>
            `);
          });
        } else {
          postsContainer.append("<p>No posts found for this category.</p>");
        }
      },
      error: function (xhr) {
        console.error(xhr.responseText);
      },
    });
  }

  loadPosts(2);

  $(".category-card").on("click", function () {
    const categoryId = $(this).data("id");
    loadPosts(categoryId);
  });
});
