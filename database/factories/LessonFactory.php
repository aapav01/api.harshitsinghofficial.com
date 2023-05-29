<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(),
            'description' => fake()->sentences(2, true),
            'thumb_url' => fake()->imageUrl(360, 360, 'animals', true, 'dogs', true),
            // 'url',
            'type' =>'Video',
            'status' => 'success',
            'platform' => 'Youtube',
            'public' => true,
            'user_id' => User::factory(),
            'chapter_id' => Chapter::factory(),
        ];
    }
}
