<?php
namespace App\Livewire\Admin\Posts;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag; // 1. Tambahkan model Tag
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManagePosts extends Component
{
    use WithPagination, WithFileUploads;

    public $postId, $title, $content, $category_id, $status;
    public $thumbnail, $existingThumbnail;
    public $isModalOpen = false;
    public $search = '';
    public $tags_input = ''; // 2. Tambahkan properti untuk input tag

    public function render()
    {
        $posts = Post::with('category', 'author', 'tags') // Eager load tags untuk ditampilkan
            ->where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        $categories = Category::all();

        return view('livewire.admin.posts.manage-posts', compact('posts', 'categories'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->postId = null;
        $this->title = '';
        $this->content = '';
        $this->category_id = '';
        $this->status = PostStatus::DRAFT->value;
        $this->thumbnail = null;
        $this->existingThumbnail = null;
        $this->tags_input = ''; // 3. Reset input tag
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|min:20',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:' . implode(',', array_column(PostStatus::cases(), 'value')),
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $thumbnailPath = $this->existingThumbnail;
        if ($this->thumbnail) {
            if ($this->existingThumbnail) {
                Storage::disk('public')->delete($this->existingThumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('thumbnails', 'public');
        }

        $postData = array_merge($validatedData, [
            'user_id' => auth()->id(),
            'thumbnail' => $thumbnailPath,
        ]);

        if ($this->status === PostStatus::PUBLISHED->value && !$this->postId) {
            $postData['published_at'] = now();
        }

        $post = Post::updateOrCreate(['id' => $this->postId], $postData);

        // 4. LOGIKA UTAMA UNTUK TAGS
        $tagIds = [];
        // Ubah string "laravel, php" menjadi array bersih ['laravel', 'php']
        $tagNames = array_filter(array_map('trim', explode(',', $this->tags_input)));

        foreach ($tagNames as $tagName) {
            // Cari tag, jika tidak ada, buat baru.
            $tag = Tag::firstOrCreate(['name' => strtolower($tagName)]);
            $tagIds[] = $tag->id;
        }
        // Sinkronkan relasi. Laravel akan menangani tabel pivot post_tag.
        $post->tags()->sync($tagIds);

        session()->flash('message', $this->postId ? 'Berita berhasil diperbarui.' : 'Berita berhasil dibuat.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $post = Post::with('tags')->findOrFail($id); // 5. Ambil post beserta tags-nya
        $this->postId = $id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->category_id = $post->category_id;
        $this->status = $post->status->value;
        $this->existingThumbnail = $post->thumbnail;

        // 6. Ubah koleksi tags menjadi string untuk ditampilkan di input
        $this->tags_input = implode(', ', $post->tags->pluck('name')->toArray());

        $this->openModal();
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        session()->flash('message', 'Berita berhasil dihapus.');
    }
}

