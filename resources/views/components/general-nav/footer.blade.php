<!-- Footer -->
<footer class="bg-gray-900 text-gray-400 py-12">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0">
                <a href="{{ route('home') }}">
                    <div class="flex items-end space-x-2">
                        <div class="h-8 w-8">
                            <img class="object-contain" src="{{ asset('images/logo.png') }}" alt="">
                        </div>
                        <span class="text-xl font-bold text-white">BLOGX</span>
                    </div>
                </a>
                <p class="mt-2 text-sm">Start your journey of bloging</p>
            </div>

            <div class="flex space-x-6">
                {{-- <a href="#" class="hover:text-white transition-colors">Twitter</a>
                <a href="#" class="hover:text-white transition-colors">Instagram</a>
                <a href="#" class="hover:text-white transition-colors">LinkedIn</a>
                <a href="#" class="hover:text-white transition-colors">RSS</a> --}}
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-sm">© 2025 BLOGX. All rights reserved.</p>
        </div>
    </div>
</footer>
</body>

</html>
