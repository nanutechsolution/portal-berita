<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-t">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - Portal Berita Profesional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">BERITA<span class="text-pink-500">PRO</span></a>
            <div>
                @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 mr-4">Log in</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Kolom Konten Utama -->
            <div class="lg:col-span-2">
                <article class="bg-white p-6 sm:p-8 rounded-lg shadow-lg">
                    <div class="mb-6">
                        <a href="{{ route('archive.category', $post->category->slug) }}" class="text-indigo-600 font-semibold hover:underline">{{ $post->category->name }}</a>
                        <h1 class="text-4xl md:text-5xl font-extrabold my-4 text-gray-900 leading-tight">{{ $post->title }}</h1>
                        <div class="flex items-center text-sm text-gray-500">
                            <span>Oleh <strong>{{ $post->author->name }}</strong></span>
                            <span class="mx-2">&bullet;</span>
                            <span>Dipublikasikan pada {{ $post->published_at->format('d F Y, H:i') }}</span>
                        </div>
                    </div>
                    <img class="w-full rounded-lg mb-8" src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://placehold.co/800x400/e2e8f0/e2e8f0?text=Berita' }}" alt="{{ $post->title }}">
                    <div class="prose max-w-none text-lg text-gray-800 leading-relaxed">
                        {!! $post->content !!}
                    </div>

                    <!-- Bagian untuk Menampilkan Tags Terkait -->
                    @if($post->tags->count() > 0)
                    <div class="mt-8 pt-6 border-t">
                        <h3 class="text-xl font-bold mb-4">Tags Terkait</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                            <a href="{{ route('archive.tag', $tag->slug) }}" class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-sm hover:bg-indigo-500 hover:text-white transition-colors duration-200">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <!-- Akhir Bagian Tags -->

                    <!-- Kolom Komentar Disisipkan di Sini -->
                    {{-- <livewire:post-comments :post="$post" /> --}}

                </article>
            </div>

            <!-- Kolom Sidebar -->
            <div class="lg:col-span-1">
                @include('post.partials.sidebar')
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-6 text-center">
            &copy; {{ date('Y') }} Portal Berita Profesional. All Rights Reserved.
        </div>
    </footer>
</body>
</html>
