<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal Berita Profesional</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-md sticky top-0 z-50">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-3xl font-bold text-indigo-600">BERITA<span class="text-pink-500">PRO</span></a>
                <div>
                    @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 mr-4">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-md">Register</a>
                    @endif
                    @endauth
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Kolom Utama -->
                <div class="lg:col-span-2">
                    <!-- Berita Utama / Headline -->
                    @if($headlinePost)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <a href="{{ route('post.show', $headlinePost->slug) }}">
                            <img class="w-full h-64 sm:h-96 object-cover" src="{{ $headlinePost->thumbnail ? asset('storage/' . $headlinePost->thumbnail) : 'https://placehold.co/800x400/e2e8f0/e2e8f0?text=Headline' }}" alt="{{ $headlinePost->title }}">
                        </a>
                        <div class="p-6">
                            <a href="{{ route('archive.category', $headlinePost->category->slug) }}" class="text-sm font-semibold text-indigo-600 hover:underline">{{ $headlinePost->category->name }}</a>
                            <h1 class="mt-2 mb-2 font-bold text-3xl md:text-4xl">
                                <a href="{{ route('post.show', $headlinePost->slug) }}" class="hover:text-indigo-700 leading-tight">{{ $headlinePost->title }}</a>
                            </h1>
                            <p class="text-gray-600 text-lg hidden sm:block">
                                {{ Str::limit(strip_tags($headlinePost->content), 200) }}
                            </p>
                        </div>
                    </div>
                    @endif

                    <!-- Berita Terbaru Lainnya -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @foreach($latestPosts as $post)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                            <a href="{{ route('post.show', $post->slug) }}">
                                <img class="w-full h-56 object-cover" src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://placehold.co/400x300/e2e8f0/e2e8f0?text=Berita' }}" alt="{{ $post->title }}">
                            </a>
                            <div class="p-6">
                                <a href="{{ route('archive.category', $post->category->slug) }}" class="text-sm font-semibold text-indigo-600 hover:underline">{{ $post->category->name }}</a>
                                <h2 class="mt-2 font-bold text-xl">
                                    <a href="{{ route('post.show', $post->slug) }}" class="hover:text-indigo-700 leading-tight">{{ $post->title }}</a>
                                </h2>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-8">
                    <!-- Berita Populer -->
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold border-b-2 border-indigo-500 pb-2 mb-4">Terpopuler</h3>
                        <div class="space-y-4">
                            @forelse($popularPosts as $post)
                            <div class="flex items-start space-x-4">
                                <div class="text-2xl font-bold text-gray-300">{{ $loop->iteration }}</div>
                                <div>
                                    <a href="{{ route('post.show', $post->slug) }}" class="font-semibold hover:text-indigo-700 leading-tight">{{ $post->title }}</a>
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500">Belum ada berita populer.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blok Kategori Tambahan -->
            @if($sportsPosts->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-2xl font-bold border-b-2 border-pink-500 pb-2 mb-6">Olahraga</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($sportsPosts as $post)
                    @include('post.partials.card', ['post' => $post])
                    @endforeach
                </div>
            </div>
            @endif

            @if($techPosts->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-2xl font-bold border-b-2 border-pink-500 pb-2 mb-6">Teknologi</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($techPosts as $post)
                    @include('post.partials.card', ['post' => $post])
                    @endforeach
                </div>
            </div>
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
