<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function showByCategory(Category $category)
    {
        $posts = $category->posts()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('archive.index', [
            'title' => 'Kategori: ' . $category->name,
            'posts' => $posts
        ]);
    }

    public function showByTag(Tag $tag)
    {
        $posts = $tag->posts()
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        return view('archive.index', [
            'title' => 'Tag: ' . $tag->name,
            'posts' => $posts
        ]);
    }
}
