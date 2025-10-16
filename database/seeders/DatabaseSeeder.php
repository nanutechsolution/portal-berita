<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat User Admin
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
        ]);

        // 2. Buat Beberapa Kategori Spesifik
        $categories = collect(['Olahraga', 'Teknologi', 'Politik', 'Ekonomi', 'Gaya Hidup'])
            ->map(fn($name) => Category::factory()->create(['name' => $name]));

        // 3. Buat Beberapa Tag
        $tags = collect(['laravel', 'pemilu 2024', 'sepakbola', 'gadget', 'saham', 'kesehatan'])
            ->map(fn($name) => Tag::factory()->create(['name' => $name]));

        // 4. Buat 50 Berita Palsu
        Post::factory(50)->create([
            'user_id' => $adminUser->id,
            'category_id' => fn() => $categories->random()->id,
        ])->each(function (Post $post) use ($tags) {
            // Lampirkan 1 sampai 3 tag secara acak ke setiap berita
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        });
    }
}
