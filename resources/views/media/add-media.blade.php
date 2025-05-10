<x-app-layout>
    <form action="#">
        @csrf

    </form>
</x-app-layout>

{{--        
            $table->id();
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type');
            $table->string('title')->nullable();
            $table->timestamps();
--}}
