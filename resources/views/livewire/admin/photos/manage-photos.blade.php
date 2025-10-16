<div class="p-6 sm:p-8">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Manajemen Galeri Foto</h1>
    </div>

    @if (session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <!-- Search Bar -->
    <div class="mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Cari foto berdasarkan caption...">
    </div>

    <!-- Galeri Foto -->
    @if($photos->count())
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($photos as $photo)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
            <div class="relative">
                <img src="{{ asset('storage/' . $photo->path) }}" alt="{{ $photo->caption ?? 'Foto Galeri' }}" class="w-full h-48 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                    <button wire:click="delete({{ $photo->id }})" wire:confirm="Anda yakin ingin menghapus foto ini?" class="text-white bg-red-600 px-3 py-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        Hapus
                    </button>
                </div>
            </div>
            <div class="p-4">
                <p class="text-sm text-gray-700 truncate" title="{{ $photo->caption }}">{{ $photo->caption ?? 'Tanpa caption' }}</p>
                <a href="{{ route('post.show', $photo->post->slug) }}" class="text-xs text-indigo-600 hover:underline mt-1 block truncate" title="Pada Berita: {{ $photo->post->title }}">
                    Pada: {{ $photo->post->title }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $photos->links() }}
    </div>
    @else
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <p class="text-gray-500">Tidak ada foto yang cocok dengan pencarian Anda.</p>
    </div>
    @endif
</div>
