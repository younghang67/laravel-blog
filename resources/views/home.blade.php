<x-general-layout title="Blogs">
    <div class="min-h-screen bg-gradient-to-br from-stone-50 via-amber-50/30 to-orange-50/20">

        <section class="relative px-6 py-20 md:py-32">
            <div class="max-w-7xl mx-auto text-center">
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-stone-900 mb-6 leading-tight">
                    Stories That
                    <span class="block text-transparent bg-gradient-to-r from-amber-600 to-orange-500 bg-clip-text">
                        Inspire & Connect
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-stone-600 mb-8 max-w-2xl mx-auto leading-relaxed">
                    Discover thoughtful writing on life, creativity, and the moments that matter most. Join our
                    community of
                    curious minds and passionate storytellers.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <Button size="lg"
                        class="bg-stone-900 hover:bg-stone-800 text-white px-8 py-3 rounded-full transition-all duration-300 hover:scale-105">
                        Start Reading
                        <ArrowRight class="ml-2 h-4 w-4" />
                    </Button>
                    <Button variant="outline" size="lg"
                        class="border-stone-300 text-stone-700 hover:bg-stone-100 px-8 py-3 rounded-full transition-all duration-300 bg-transparent">
                        Subscribe to Newsletter
                    </Button>
                </div>
            </div>
        </section>


        <section class="px-6 py-16">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-stone-900 text-center mb-4">Latest Stories</h2>
                <p class="text-lg md:text-xl text-stone-600 max-w-2xl mx-auto leading-relaxed text-center mb-12">
                    Catch up on the
                    latest happenings, trends, and ideas shaping the conversation today.</p>
                @php
                    $layouts = [
                        'md:col-span-2 lg:col-span-3 md:row-span-2 group cursor-pointer overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1',
                        'md:col-span-2 lg:col-span-2 group cursor-pointer overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1',
                        'md:col-span-2 lg:col-span-1 group cursor-pointer overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1 small-post',
                        'md:col-span-2 lg:col-span-2 group cursor-pointer overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1',
                        'md:col-span-2 lg:col-span-1 group cursor-pointer overflow-hidden border-0 shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1 small-post',
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4 h-auto md:h-[600px]">
                    {{-- {{ dd($blogs) }} --}}
                    @foreach ($blogs as $key => $blog)
                        <a href="{{ route('blogs.single', $blog) }}"
                            class="{{ $layouts[$key] ?? 'col-span-1 row-span-1' }} object-center">
                            <div class="relative h-full">
                                <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-orange-500 opacity-90">
                                    <img src="{{ asset($blog->image_url ?? 'images/placeholder-image.png') }}"
                                        class="object-cover" alt="">
                                </div>
                                <div class="relative h-full p-8 flex flex-col justify-end text-white">
                                    <span class="w-fit mb-4 bg-white/20 text-white border-white/30 px-2 badge">
                                        {{ $blog->category->name }}
                                    </span>
                                    <h3 class="text-2xl md:text-3xl font-bold mb-4 leading-tight">
                                        {{ $blog->title }}
                                    </h3>
                                    <div class="flex items-center gap-4 text-sm text-white/80">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <span>{{ $blog->user->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                    {{-- <Card class="">
                        <div class="relative h-full">
                            <div class="absolute inset-0 bg-gradient-to-br from-stone-600 to-stone-800 opacity-90">
                            </div>
                            <div class="relative h-full p-6 flex flex-col justify-end text-white">
                                <Badge class="w-fit mb-3 bg-white/20 text-white border-white/30">Travel</Badge>
                                <h3 class="text-xl font-bold mb-3 leading-tight">Hidden Gems of Kyoto</h3>
                                <p class="text-white/90 text-sm mb-4">
                                    Beyond the tourist trails lie stories waiting to be discovered.
                                </p>
                                <div class="flex items-center gap-2 text-xs text-white/70">
                                    <User class="h-3 w-3" />
                                    <span>Alex Kim</span>
                                </div>
                            </div>
                        </div>
                    </Card>


                    <Card class="">
                        <div class="relative h-full">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-400 to-teal-500 opacity-90">
                            </div>
                            <div class="relative h-full p-4 flex flex-col justify-end text-white">
                                <Badge class="w-fit mb-2 bg-white/20 text-white border-white/30 text-xs">Tech
                                </Badge>
                                <h3 class="text-sm font-bold mb-2 leading-tight">Coding with Purpose</h3>
                                <div class="flex items-center gap-1 text-xs text-white/70">
                                    <User class="h-3 w-3" />
                                    <span>Maya Patel</span>
                                </div>
                            </div>
                        </div>
                    </Card>


                    <Card class="">
                        <div class="relative h-full">
                            <div class="absolute inset-0 bg-gradient-to-br from-rose-400 to-pink-500 opacity-90">
                            </div>
                            <div class="relative h-full p-6 flex flex-col justify-end text-white">
                                <Badge class="w-fit mb-3 bg-white/20 text-white border-white/30">Lifestyle</Badge>
                                <h3 class="text-xl font-bold mb-3 leading-tight">Morning Rituals That Changed My
                                    Life</h3>
                                <p class="text-white/90 text-sm mb-4">Small habits, profound transformations.</p>
                                <div class="flex items-center gap-2 text-xs text-white/70">
                                    <User class="h-3 w-3" />
                                    <span>Jordan Lee</span>
                                </div>
                            </div>
                        </div>
                    </Card>


                    <Card class="">
                        <div class="relative h-full">
                            <div class="absolute inset-0 bg-gradient-to-br from-violet-400 to-purple-500 opacity-90">
                            </div>
                            <div class="relative h-full p-4 flex flex-col justify-end text-white">
                                <Badge class="w-fit mb-2 bg-white/20 text-white border-white/30 text-xs">Art</Badge>
                                <h3 class="text-sm font-bold mb-2 leading-tight">Colors of Memory</h3>
                                <div class="flex items-center gap-1 text-xs text-white/70">
                                    <User class="h-3 w-3" />
                                    <span>Elena Rodriguez</span>
                                </div>
                            </div>
                        </div>
                    </Card> --}}
                </div>
            </div>
        </section>


        <section class="px-6 py-16 bg-white/50">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-stone-900 mb-12 text-center">Explore by Category</h2>

                @php
                    $colors = [
                        'from-amber-400 to-orange-500',
                        'from-stone-500 to-stone-700',
                        'from-rose-400 to-pink-500',
                        'from-emerald-400 to-teal-500',
                        'from-violet-400 to-purple-500',
                        'from-blue-400 to-indigo-500',
                    ];
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    @foreach ($categories as $key => $cat)
                        {{-- {{dd($cat)}} --}}
                        <div
                            class="group cursor-pointer border-0 shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                            <div class="p-6 text-center">
                                <div
                                    class="w-12 h-12 mx-auto mb-4 rounded-full bg-gradient-to-br {{ $colors[$key] }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-stone-900 mb-1">{{ $cat->name }}</h3>
                                <p class="text-sm text-stone-600">{{ $cat->posts_count }} posts</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>


        {{-- <section class="px-6 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="w-24 h-24 mx-auto mb-8 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                    <User class="h-12 w-12 text-white" />
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-stone-900 mb-6">Hello, I'm Sarah</h2>
                <p class="text-lg text-stone-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                    A storyteller, dreamer, and coffee enthusiast sharing thoughts on life's beautiful complexities.
                    Through
                    words, I explore the intersection of creativity, mindfulness, and human connection. Welcome to my
                    corner of
                    the internet where every story matters.
                </p>
                <Button variant="outline"
                    class="border-stone-300 text-stone-700 hover:bg-stone-100 px-6 py-2 rounded-full transition-all duration-300 bg-transparent">
                    Read My Story
                </Button>
            </div>
        </section> --}}
    </div>
</x-general-layout>
