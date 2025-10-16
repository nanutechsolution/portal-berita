<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil satu berita yang ditandai sebagai headline
        $headlinePost = Post::where('is_headline', true)
            ->where('status', 'published')
            ->latest('published_at')
            ->first();

        // 2. Ambil berita terbaru, lewati headline jika ada
        $latestPosts = Post::with('category', 'author')
            ->where('status', 'published')
            ->when($headlinePost, function ($query) use ($headlinePost) {
                $query->where('id', '!=', $headlinePost->id);
            })
            ->latest('published_at')
            ->take(6)
            ->get();

        // 3. Ambil berita terpopuler
        $popularPosts = Post::where('status', 'published')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        // 4. Ambil berita dari kategori spesifik (contoh)
        $sportsCategory = Category::where('slug', 'olahraga')->first();
        $sportsPosts = $sportsCategory ? $sportsCategory->posts()
            ->where('status', 'published')->latest('published_at')->take(4)->get() : collect();

        $techCategory = Category::where('slug', 'teknologi')->first();
        $techPosts = $techCategory ? $techCategory->posts()
            ->where('status', 'published')->latest('published_at')->take(4)->get() : collect();


        return view('welcome', compact(
            'headlinePost',
            'latestPosts',
            'popularPosts',
            'sportsPosts',
            'techPosts'
        ));
    }

    public function show(Post $post)
    {
        // if ($post->status !== 'published' && (auth()->guest() || !auth()->user()->isAdmin())) {
        //     abort(404);
        // }

        $post->increment('views_count');

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(4)
            ->get();

        $popularPosts = Post::where('status', 'published')
            ->orderBy('views_count', 'desc')
            ->take(5)
            ->get();

        return view('post.show', compact('post', 'relatedPosts', 'popularPosts'));
    }
}


