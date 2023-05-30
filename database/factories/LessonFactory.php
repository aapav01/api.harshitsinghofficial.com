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
        $url = null;
        $type = fake()->randomElement(['video', 'quiz']);
        if ($type == 'video') $url = fake()->randomElement([
            'https://www.youtube.com/watch?v=Q530u_g2CWE',
            'https://www.youtube.com/watch?v=nas28_u-dJw',
            'https://www.youtube.com/watch?v=jLhFWNA029Y',
            'https://www.youtube.com/watch?v=lQz9oVot6fE',
            'https://www.youtube.com/watch?v=ew0kqWuNpMo',
        ]);
        return [
            'title' => fake()->unique()->sentence(),
            'description' => fake()->sentences(2, true),
            'thumb_url' => fake()->imageUrl(360, 360, 'animals', true, 'dogs', true),
            'url' => $url,
            'type' => $type,
            'status' => 'success',
            'platform' => 'Youtube',
            'public' => true,
            'user_id' => User::factory(),
            'chapter_id' => Chapter::factory(),
        ];
    }
}
