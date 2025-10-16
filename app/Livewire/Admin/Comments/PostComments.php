<?php

namespace App\Comments\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public Post $post;
    public $newComment = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:3',
        ]);

        $this->post->comments()->create([
            'content' => $this->newComment,
            'user_id' => auth()->id(),
            'status' => 'pending', // Semua komentar baru menunggu persetujuan
        ]);

        $this->newComment = '';
        session()->flash('comment_message', 'Komentar Anda telah dikirim dan sedang menunggu persetujuan.');
    }

    public function render()
    {
        $comments = $this->post->comments()
            ->where('status', 'approved')
            ->whereNull('parent_id') // Hanya ambil komentar utama
            ->with('author', 'replies.author') // Eager load relasi
            ->latest()
            ->get();

        return view('livewire.post-comments', compact('comments'));
    }
}

