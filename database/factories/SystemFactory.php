<?php

namespace Database\Factories;

use App\Enums\Genres;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\System>
 */
class SystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'created_at' => now(),
            'updated_at' => now(),
            'genre' => Genres::getRandomValue(),
        ];
    }
}
