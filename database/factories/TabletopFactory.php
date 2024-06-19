<?php

namespace Database\Factories;

use App\Enums\Frequency;
use App\Enums\Genres;
use App\Enums\Levels;
use App\Enums\Provinces;
use App\Enums\WeekDays;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tabletop>
 */
class TabletopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->text(900),
            'city' => fake()->city(),
            'presencial' => fake()->boolean(),
            'frequency' => Frequency::getRandomValue(),
            'weekday' => WeekDays::getRandomValue(),
            'horary' => fake()->time(),
            'next_session' => fake()->dateTimeBetween('+0 days', '+1 years'),
            'genre' => Genres::getRandomValue(),
            'level' => Levels::getRandomValue(),
            'province' => Provinces::getRandomValue(),
        ];
    }
}
