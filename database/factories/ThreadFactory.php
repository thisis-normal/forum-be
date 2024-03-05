<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 20),
            'forum_id' => $this->faker->numberBetween(1, 20),
            'prefix_id' => $this->faker->numberBetween(1, 6),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'locked' => $this->faker->boolean,
            'pinned' => $this->faker->boolean,
            'views' => $this->faker->numberBetween(0, 1000),
            'replies' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
