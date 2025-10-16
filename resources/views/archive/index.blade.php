<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-layouts.partials.seo :title="$title" :description="$description" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50 text-gray-800">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">BERITA<span class="text-pink-500">KITA</span></a>
                <div>
                    @if (Route::has('login'))
                    @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 mr-4">Log in</a>
                    @endauth
                    @endif
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-12">
            <div class="border-b-2 border-indigo-500 pb-4 mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900">{{ $title }}</h1>
            </div>

            @if($posts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($posts as $post)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                    <a href="{{ route('post.show', $post->slug) }}">
                        <img class="w-full h-56 object-cover" src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://placehold.co/400x300/e2e8f0/e2e8f0' }}" alt="{{ $post->title }}">
                    </a>
                    <div class="p-6">
                        <a href="{{ route('archive.category', $post->category->slug) }}" class="text-sm font-semibold text-indigo-600 hover:underline">{{ $post->category->name }}</a>
                        <h2 class="mt-2 mb-2 font-bold text-2xl">
                            <a href="{{ route('post.show', $post->slug) }}" class="hover:text-indigo-700">{{ $post->title }}</a>
                        </h2>
                        <div class="flex items-center text-xs text-gray-500">
                            <span>Oleh {{ $post->author->name }}</span>
                            <span class="mx-2">&bullet;</span>
                            <span>{{ $post->published_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-12">
                {{ $posts->links() }}
            </div>
            @else
            <p class="text-center col-span-3 text-gray-500 text-lg">Tidak ada berita yang ditemukan di {{ $title }}.</p>
            @endif
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            &copy; {{ date('Y') }} Portal Berita Profesional. All Rights Reserved.
        </div>
    </footer>
</body>
</html>
