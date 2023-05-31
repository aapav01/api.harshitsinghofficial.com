<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->sentence();

        return [
            'name' => $name,
            'short' => fake()->sentences(2, true),
            'description' => fake()->paragraph(),
            'slug' => Str::slug($name, '-'),
            'image' => fake()->imageUrl(720, 420, 'animals', true, null, true),
            'latest_price' => fake()->randomNumber(3, true),
            'before_price' => fake()->randomNumber(3, true),
            'public' => true,
            'publish_at' => now(),
            'user_id' => User::factory(),
        ];
    }
}
