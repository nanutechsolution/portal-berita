    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
        <a href="{{ route('post.show', $post->slug) }}">
            <img class="w-full h-48 object-cover" src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://placehold.co/400x300/e2e8f0/e2e8f0?text=Berita' }}" alt="{{ $post->title }}">
        </a>
        <div class="p-4">
            <a href="{{ route('archive.category', $post->category->slug) }}" class="text-sm font-semibold text-indigo-600 hover:underline">{{ $post->category->name }}</a>
            <h2 class="mt-2 font-bold text-lg">
                <a href="{{ route('post.show', $post->slug) }}" class="hover:text-indigo-700 leading-tight">{{ $post->title }}</a>
            </h2>
        </div>
    </div>

