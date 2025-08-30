<div id="general-sidebar-menu" class="absolute justify-end h-dvh w-dvw top-0 right-0 z-30">
    <div id="general-sidebar-bg"
        class="absolute top-0 left-0 h-dvh w-dvw z-50 opacity-40 bg-slate-950 pointer-events-none">
    </div>
    <div id="general-sidebar-nav" class="bg-black h-dvh w-[600px] text-white opacity-100 relative z-50 p-6">
        <button id="general-nav-menu-close-btn" class="pt-6">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-9 cursor-pointer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <ul class="mt-4 ml-2 space-y-3">
            <li>
                <a href="{{ route('blog.all.list') }}" class="inline font-semibold"> All Blogs</a>
            </li>
            <li>
                <a href="latest-posts" class="inline font-semibold">Latest Posts</a>
            </li>
        </ul>
    </div>
</div>
