<div class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black bg-opacity-75" x-data @keydown.escape.window="$wire.closeModal()">
    <div class="w-full max-w-4xl p-8 mx-auto bg-white rounded-lg shadow-xl">
        <div class="flex items-center justify-between pb-4 border-b">
            <h2 class="text-2xl font-bold">{{ $postId ? 'Edit Berita' : 'Tulis Berita Baru' }}</h2>
            <button wire:click="closeModal()" class="text-gray-600 hover:text-gray-900 text-3xl">&times;</button>
        </div>
        <form wire:submit.prevent="store" class="mt-6" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Kolom Kiri -->
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-bold text-gray-700">Judul Berita</label>
                        <input type="text" id="title" wire:model.lazy="title" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="content-editor" class="block mb-2 text-sm font-bold text-gray-700">Konten</label>
                        <div wire:ignore x-data="{
                                content: @entangle('content')
                            }" x-init="
    let trix = document.getElementById('content-editor-{{ $postId }}');

    // Load konten dari entangled 'content' ke trix saat pertama kali render
    trix.addEventListener('trix-initialize', () => {
        trix.editor.loadHTML(content || '');
    });

    trix.addEventListener('trix-change', event => {
        content = trix.editor.getDocument().toString();
    });

    $watch('content', value => {
        if (!trix.editor) return;
        if (value === null || value === '') {
            trix.editor.loadHTML('');
        }
    });
">
                            <input id="content" type="hidden" name="content" :value="content">
                            <trix-editor id="content-editor-{{ $postId }}" input="content" class="trix-content"></trix-editor>
                        </div>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
                <!-- Kolom Kanan (Sidebar) -->
                <div class="space-y-4">
                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-bold text-gray-700">Kategori</label>
                        <select id="category_id" wire:model="category_id" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-bold text-gray-700">Status</label>
                        <select id="status" wire:model="status" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label for="tags_input" class="block mb-2 text-sm font-bold text-gray-700">Tags</label>
                        <input type="text" id="tags_input" wire:model.lazy="tags_input" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="laravel, php, berita">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan setiap tag dengan koma.</p>
                    </div>
                    <div>
                        <label for="thumbnail" class="block mb-2 text-sm font-bold text-gray-700">Thumbnail</label>
                        <input type="file" id="thumbnail" wire:model="thumbnail" class="w-full">
                        <div wire:loading wire:target="thumbnail" class="text-sm text-gray-500 mt-1">Uploading...</div>
                        @if ($thumbnail)
                        <img src="{{ $thumbnail->temporaryUrl() }}" class="mt-2 w-full rounded">
                        @elseif ($existingThumbnail)
                        <img src="{{ asset('storage/' . $existingThumbnail) }}" class="mt-2 w-full rounded">
                        @endif
                        @error('thumbnail') <span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t mt-6">
                <button type="button" wire:click="closeModal()" class="px-4 py-2 mr-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700" wire:loading.attr="disabled">
                    <span wire:loading.remove>Simpan Berita</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('livewire:navigated', () => {
        // Membersihkan event listener lama untuk menghindari duplikasi
        if (window.trixClearListener) {
            document.removeEventListener('trix-clear', window.trixClearListener);
        }
        window.trixClearListener = () => {
            document.querySelectorAll('trix-editor').forEach(editor => {
                editor.editor.loadHTML('');
            });
        };
        document.addEventListener('trix-clear', window.trixClearListener);
    });

</script>
