    <div class="mt-8 pt-6 border-t">
        <h3 class="text-2xl font-bold mb-6">Diskusi ({{ $comments->count() }})</h3>

        <!-- Form untuk Menulis Komentar Baru -->
        @auth
        @if (session()->has('comment_message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('comment_message') }}</span>
        </div>
        @endif
        <form wire:submit.prevent="addComment">
            <textarea wire:model.defer="newComment" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" rows="4" placeholder="Tulis komentar Anda..."></textarea>
            @error('newComment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">Kirim Komentar</button>
        </form>
        @else
        <p class="mb-4"><a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Masuk</a> untuk menulis komentar.</p>
        @endauth

        <!-- Daftar Komentar yang Sudah Disetujui -->
        <div class="mt-8 space-y-6">
            @forelse ($comments as $comment)
            <div class="flex space-x-4">
                <div class="flex-shrink-0">
                    <!-- Placeholder untuk avatar -->
                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center font-bold text-gray-600">
                        {{ substr($comment->author->name, 0, 1) }}
                    </div>
                </div>
                <div>
                    <div class="font-bold">{{ $comment->author->name }}</div>
                    <div class="text-gray-600 text-sm">{{ $comment->created_at->diffForHumans() }}</div>
                    <p class="mt-2 text-gray-800">{{ $comment->content }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500">Jadilah yang pertama berkomentar.</p>
            @endforelse
        </div>
    </div>
