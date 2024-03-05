<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'forum_group_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
