import $ from "jquery";

$(function () {
  $("#createComment").submit(function (e) {
    e.preventDefault();

    var comment = $("#comment").val();
    var post_id = $("#post_id").val();
    var _token = $("input[name='_token']").val();

    $.ajax({
      type: "POST",
      url: window.commentStoreUrl,
      data: {
        _token: _token,
        comment: comment,
        post_id: post_id,
      },
      success: function (response) {
        // Clear input
        $("#comment").val("");

        // Build HTML using your Blade layout structure
        let newComment = `
  <div
    class="w-full p-6 bg-white rounded-2xl border border-gray-200 flex-col justify-start items-start gap-8 flex">
    <div class="w-full flex-col justify-center items-start gap-3.5 flex">
        <div class="w-full justify-between items-center inline-flex">
            <div class="justify-start items-center gap-2.5 flex">
                <div
                    class="w-10 h-10 bg-gray-300 rounded-full justify-center items-center gap-2.5 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="size-7">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>

                </div>
                <div class="flex-col justify-start items-start gap-1 inline-flex">
                    <h5 class="text-gray-900 text-sm font-semibold leading-snug">
                         ${response.comment.user.name}
                    </h5>
                    <p class="text-gray-500 text-xs font-normal leading-5">
                        ${new Date(response.comment.created_at).toLocaleDateString("en-US", { day: "2-digit", month: "long", year: "numeric" })}
                    </p>
                </div>
            </div>
            <div class="w-6 h-6 relative">
                <div class="w-full h-fit flex">
                    <div class="relative w-full">
                        <div
                            class=" absolute left-0 top-0 py-2.5 px-4 text-gray-300">
                        </div>
                        <button id="dropdown-button" data-target="dropdown-1"
                            class="w-full justify-center dropdown-toggle flex-shrink-0 z-10 flex items-center text-base font-medium text-center text-gray-900 bg-transparent  absolute right-0 top-0"
                            type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12.0161 16.9893V17.0393M12.0161 11.9756V12.0256M12.0161 6.96191V7.01191"
                                    stroke="black" stroke-width="2.5"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-gray-800 text-sm font-normal leading-snug">
            ${response.comment.comment}
</p>
    </div>
</div>

  `;

        // Append to comments list
        $("#commentsList").append(newComment);
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
});
