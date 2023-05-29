<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->has(Course::factory(3)->has(Chapter::factory(5)->has(Lesson::factory(10))))->create([
            'name' => 'Harshit Singh',
            'email' => 'harshit@lpcs.co.in',
        ]);

    }
}
