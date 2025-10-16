    <aside class="space-y-8">
        <!-- Berita Populer -->
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4 border-b-2 border-indigo-500 pb-2">Berita Populer</h3>
            <ul class="space-y-4">
                @forelse($popularPosts as $p_post)
                <li class="flex items-start space-x-4">
                    <img src="{{ $p_post->thumbnail ? asset('storage/' . $p_post->thumbnail) : 'https://placehold.co/100x75/e2e8f0/e2e8f0' }}" alt="{{ $p_post->title }}" class="w-24 h-16 object-cover rounded">
                    <div>
                        <a href="{{ route('post.show', $p_post->slug) }}" class="font-semibold text-gray-800 hover:text-indigo-600 leading-tight">
                            {{ Str::limit($p_post->title, 55) }}
                        </a>
                        <div class="text-xs text-gray-500 mt-1">{{ $p_post->published_at->format('d M Y') }}</div>
                    </div>
                </li>
                @empty
                <li class="text-gray-500">Belum ada berita populer.</li>
                @endforelse
            </ul>
        </div>

        <!-- Berita Terkait -->
        @if($relatedPosts->count() > 0)
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h3 class="text-xl font-bold mb-4 border-b-2 border-indigo-500 pb-2">Berita Terkait</h3>
            <ul class="space-y-4">
                @foreach($relatedPosts as $r_post)
                <li class="flex items-start space-x-4">
                    <img src="{{ $r_post->thumbnail ? asset('storage/' . $r_post->thumbnail) : 'https://placehold.co/100x75/e2e8f0/e2e8f0' }}" alt="{{ $r_post->title }}" class="w-24 h-16 object-cover rounded">
                    <div>
                        <a href="{{ route('post.show', $r_post->slug) }}" class="font-semibold text-gray-800 hover:text-indigo-600 leading-tight">
                            {{ Str::limit($r_post->title, 55) }}
                        </a>
                        <div class="text-xs text-gray-500 mt-1">{{ $r_post->published_at->format('d M Y') }}</div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </aside>
