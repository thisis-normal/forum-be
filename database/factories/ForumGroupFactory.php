<?php

namespace Database\Factories;

use App\Models\ForumGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ForumGroup>
 */
class ForumGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
