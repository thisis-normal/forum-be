<?php

namespace Database\Factories;

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
            'user_id' => $this->faker->numberBetween(1, 20),
            'thread_id' => $this->faker->numberBetween(1, 20),
            'body' => $this->faker->paragraph,
            'likes' => $this->faker->numberBetween(0, 1000),
            'dislikes' => $this->faker->numberBetween(0, 1000),
            'replied_to' => $this->faker->numberBetween(1, 20),
            'edited' => $this->faker->boolean,
            'image_path' => $this->faker->imageUrl,
        ];
    }
}
