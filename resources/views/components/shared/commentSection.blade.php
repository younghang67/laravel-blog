        <section class="py-24 relative" id="comment-section">

            <div class="max-w-5xl mx-auto px-4 md:px-5 lg:px-5">
                <div class="w-full flex-col justify-start items-start lg:gap-10 gap-6 inline-flex">
                    <h2 class="text-gray-900 text-3xl font-bold font-manrope leading-normal">{{ $totalComments }}
                        Comments</h2>
                    <div class="w-full flex-col justify-start items-start lg:gap-9 gap-6 flex">
                        @if (auth()->check())
                            <script>
                                window.commentStoreUrl = "{{ route('comments.store') }}";
                            </script>
                            <form method="POST" id="createComment" class="w-full relative flex justify-between gap-2">
                                @csrf
                                <textarea type="text" name="comment" id="comment" required placeholder="Write Your thoughts...."
                                    class="w-full rounded-lg border border-gray-300 bg-white shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] focus:outline-none text-gray-900 placeholder-gray-400 font-normal text-sm leading-relaxed"></textarea>
                                <input type="hidden" name="post_id" id="post_id" value="{{ $blog->id }}">
                                <button title="comment submit button" type="submit"
                                    class="absolute right-6 top-[18px]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none">
                                        <path
                                            d="M11.3011 8.69906L8.17808 11.8221M8.62402 12.5909L8.79264 12.8821C10.3882 15.638 11.1859 17.016 12.2575 16.9068C13.3291 16.7977 13.8326 15.2871 14.8397 12.2661L16.2842 7.93238C17.2041 5.17273 17.6641 3.79291 16.9357 3.06455C16.2073 2.33619 14.8275 2.79613 12.0679 3.71601L7.73416 5.16058C4.71311 6.16759 3.20259 6.6711 3.09342 7.7427C2.98425 8.81431 4.36221 9.61207 7.11813 11.2076L7.40938 11.3762C7.79182 11.5976 7.98303 11.7083 8.13747 11.8628C8.29191 12.0172 8.40261 12.2084 8.62402 12.5909Z"
                                            stroke="#111827" stroke-width="1.6" stroke-linecap="round" />
                                    </svg>
                                </button>
                            </form>
                        @else
                            <p>Please <a href="{{ route('dashboard') }}"
                                    class="inline underline hover:text-accentHover transition-colors">login</a> to post
                                comment</p>
                        @endif
                        <div class="w-full flex-col justify-start items-start gap-8 flex">
                            <div class="w-full flex-col justify-start items-end gap-5 flex" id="commentsList">

                                {{-- parent comment --}}
                                @foreach ($comments as $comment)
                                    {{-- parent post --}}
                                    <div x-data="{ dropDown: false, editForm: false }"
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
                                                            {{ $comment->user->name }}
                                                        </h5>
                                                        <p class="text-gray-500 text-xs font-normal leading-5">
                                                            {{ \Carbon\Carbon::parse($comment->created_at)->format('d F Y') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="w-6 h-6 relative">
                                                    <div class="w-full h-fit flex">
                                                        <div class="relative w-full">
                                                            <div
                                                                class=" absolute left-0 top-0 py-2.5 px-4 text-gray-300">
                                                            </div>
                                                            @auth
                                                                @if (auth()->id() === $comment->user_id)
                                                                    <button @click="dropDown = !dropDown"
                                                                        class="w-full justify-center dropdown-toggle flex-shrink-0 z-10 flex items-center text-base font-medium text-center text-gray-900 bg-transparent  absolute right-0 top-0"
                                                                        type="button">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24"
                                                                            viewBox="0 0 24 24" fill="none">
                                                                            <path
                                                                                d="M12.0161 16.9893V17.0393M12.0161 11.9756V12.0256M12.0161 6.96191V7.01191"
                                                                                stroke="black" stroke-width="2.5"
                                                                                stroke-linecap="round" />
                                                                        </svg>
                                                                    </button>
                                                                @endif
                                                            @endauth
                                                            <div x-show="dropDown" @click.outside="dropDown = false"
                                                                class="absolute top-10 right-0 z-20 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                                                <ul class="py-2 text-sm text-gray-700 "
                                                                    aria-labelledby="dropdown-button">
                                                                    <li @click="dropDown = !dropDown">
                                                                        <a @click="editForm = !editForm"
                                                                            class="block px-4 py-2 hover:bg-gray-100 cursor-pointer">Edit</a>
                                                                    </li>
                                                                    <li @click="dropDown = !dropDown">
                                                                        <form
                                                                            action="{{ route('comments.destroy', $comment->id) }}"
                                                                            method="POST" class="inline-block w-full">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                onclick="return confirm('Are you sure you want to delete this comment?');"
                                                                                class="text-red-600 hover:text-red-800 text-left px-4 py-2 hover:bg-gray-100 cursor-pointer w-full">
                                                                                Delete
                                                                            </button>
                                                                        </form>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-gray-800 text-sm font-normal leading-snug">
                                                {{ $comment->comment }} </p>
                                            <div x-show="editForm" class="w-full">
                                                <form action="{{ route('comments.update', $comment->id) }}"
                                                    method="POST" class="w-full relative flex justify-between gap-2">
                                                    @csrf
                                                    @method('PUT')

                                                    <textarea name="comment" id="comment" required placeholder="Write Your thoughts...."
                                                        class="w-full rounded-lg border border-gray-300 bg-white shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] focus:outline-none text-gray-900 placeholder-gray-400 font-normal text-sm leading-relaxed">{{ $comment->comment }}</textarea>
                                                    <input type="hidden" name="post_id" value="{{ $blog->id }}">
                                                    <input type="hidden" name="id" value="{{ $comment->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $comment->user_id }}">
                                                    <button title="comment submit button" type="submit"
                                                        class="absolute right-6 top-[18px]">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 20 20" fill="none">
                                                            <path
                                                                d="M11.3011 8.69906L8.17808 11.8221M8.62402 12.5909L8.79264 12.8821C10.3882 15.638 11.1859 17.016 12.2575 16.9068C13.3291 16.7977 13.8326 15.2871 14.8397 12.2661L16.2842 7.93238C17.2041 5.17273 17.6641 3.79291 16.9357 3.06455C16.2073 2.33619 14.8275 2.79613 12.0679 3.71601L7.73416 5.16058C4.71311 6.16759 3.20259 6.6711 3.09342 7.7427C2.98425 8.81431 4.36221 9.61207 7.11813 11.2076L7.40938 11.3762C7.79182 11.5976 7.98303 11.7083 8.13747 11.8628C8.29191 12.0172 8.40261 12.2084 8.62402 12.5909Z"
                                                                stroke="#111827" stroke-width="1.6"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
