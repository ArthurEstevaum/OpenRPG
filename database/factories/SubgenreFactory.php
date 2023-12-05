<?php

namespace Database\Factories;

use App\Enums\SubGenres;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subgenre>
 */
class SubgenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => SubGenres::getRandomValue()
        ];
    }
}
