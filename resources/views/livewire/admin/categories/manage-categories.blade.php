<div class="p-6 sm:p-8">
    <div class="flex flex-col sm:flex-row items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Manajemen Kategori</h1>
        <button wire:click="create()" class="w-full sm:w-auto px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 shadow-md">
            Tambah Kategori Baru
        </button>
    </div>

    @if (session()->has('message'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
        {{ session('message') }}
    </div>
    @endif
    @if (session()->has('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if($isModalOpen)
    @include('livewire.admin.categories.modal')
    @endif

    <!-- Search Bar -->
    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Cari nama kategori...">
    </div>

    <!-- Tabel Kategori -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Deskripsi</th>
                    <th class="px-4 py-3">Jumlah Berita</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                @forelse($categories as $category)
                <tr class="text-gray-700">
                    <td class="px-4 py-3 text-sm font-semibold">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-sm">{{ Str::limit($category->description, 50) }}</td>
                    <td class="px-4 py-3 text-sm">{{ $category->posts()->count() }}</td>
                    <td class="px-4 py-3 text-sm">
                        <button wire:click="edit({{ $category->id }})" class="px-3 py-1 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Edit</button>
                        <button wire:click="delete({{ $category->id }})" wire:confirm="Anda yakin ingin menghapus kategori ini?" class="px-3 py-1 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
