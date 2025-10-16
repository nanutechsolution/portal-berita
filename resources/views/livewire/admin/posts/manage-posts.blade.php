    <div class="p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Manajemen Berita</h1>
            <button wire:click="create()" class="w-full sm:w-auto px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 shadow-md">
                Tulis Berita Baru
            </button>
        </div>

        @if (session()->has('message'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('message') }}
        </div>
        @endif

        @if($isModalOpen)
        @include('livewire.admin.posts.modal')
        @endif

        <div class="mb-4">
            <input wire:model.live.debounce.300ms="search" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Cari judul berita...">
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">Judul</th>
                        <th class="px-4 py-3">Penulis</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse($posts as $post)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm font-semibold">{{ Str::limit($post->title, 40) }}</td>
                        <td class="px-4 py-3 text-sm">{{ $post->author->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $post->category->name }}</td>
                        <td class="px-4 py-3 text-xs">
                            <span @class([ 'px-2 py-1 font-semibold leading-tight rounded-full' , 'text-green-700 bg-green-100'=> $post->status === \App\Enums\PostStatus::PUBLISHED,
                                'text-yellow-700 bg-yellow-100' => $post->status === \App\Enums\PostStatus::PENDING,
                                'text-gray-700 bg-gray-100' => $post->status === \App\Enums\PostStatus::DRAFT,
                                'text-red-700 bg-red-100' => $post->status === \App\Enums\PostStatus::ARCHIVED,
                                ])>
                                {{ $post->status->value }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <button wire:click="edit({{ $post->id }})" class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Edit</button>
                            <button wire:click="delete({{ $post->id }})" wire:confirm="Anda yakin ingin menghapus berita ini?" class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center">Belum ada berita.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $posts->links() }}</div>
    </div>
