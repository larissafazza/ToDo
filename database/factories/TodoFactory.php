<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->sentence(),
            'user_id' => 1,
            'file_path' => null, 
            'date' => fake()->date(),
            'priority' => 'Not a priority',
            'done' => 0,
            'completed' => null
        ];
    }
}
