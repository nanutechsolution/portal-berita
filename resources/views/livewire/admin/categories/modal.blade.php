<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-75">
    <div class="w-full max-w-lg p-8 mx-auto bg-white rounded-lg shadow-xl" @click.away="$wire.closeModal()">
        <div class="flex items-center justify-between pb-4 border-b">
            <h2 class="text-2xl font-bold">{{ $categoryId ? 'Edit Kategori' : 'Buat Kategori Baru' }}</h2>
            <button wire:click="closeModal()" class="text-gray-600 hover:text-gray-900 text-3xl">&times;</button>
        </div>
        <form wire:submit.prevent="store" class="mt-6">
            <div class="mb-4">
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Nama Kategori</label>
                <input type="text" id="name" wire:model.lazy="name" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-bold text-gray-700">Deskripsi</label>
                <textarea id="description" wire:model.lazy="description" rows="4" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <div class="flex justify-end pt-6 border-t">
                <button type="button" wire:click="closeModal()" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                    <span wire:loading.remove wire:target="store">Simpan</span>
                    <span wire:loading wire:target="store">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
