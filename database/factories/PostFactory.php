<?php

namespace Database\Factories;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::first() ?? User::factory(),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $this->faker->sentence(6),
            'content' => '<p>' . implode('</p><p>', $this->faker->paragraphs(10)) . '</p>',
            'status' => PostStatus::PUBLISHED,
            'is_headline' => $this->faker->boolean(10), // 10% chance to be a headline
            'views_count' => $this->faker->numberBetween(100, 25000),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}

