<?php

namespace Database\Factories;

use App\Enums\Frequency;
use App\Enums\Genres;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Provinces;
use App\Enums\SubGenres;
use App\Enums\Levels;
use App\Enums\WeekDays;
use Illuminate\Support\Facades\DB;

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
        /*$first and $latest variables serve for
        fetch the first and latest ids from systems/scenarios table
        since system model isn't able to have a factory
        to make a relationship with tabletop factory*/

        $firstSystem = DB::table('systems')->first();
        $latestSystem = DB::table('systems')->orderBy('id', 'desc')->first();
        $chosenSystem = fake()->numberBetween($firstSystem->id, $latestSystem->id);

        //the first and latest scenario depends on random system choosed,
        //so the scenario of the tabletop will correspond to it system.
        $firstScenario = DB::table('scenarios')->where('system_id', '=', $chosenSystem)->first();
        $latestScenario = DB::table('scenarios')->where('system_id', '=', $chosenSystem)
        ->orderBy('id', 'desc')->first();

        return [
            'name' => fake()->word(),
            'system_id' => $chosenSystem,
            'scenario_id' => fake()->numberBetween($firstScenario->id, $latestScenario->id),
            'description' => fake()->text(1000),
            'city' => fake()->city(),
            'presencial' => fake()->boolean(),
            'frequency' => Frequency::getRandomValue(),
            'weekday' => WeekDays::getRandomValue(),
            'horary' => fake()->time(),
            'next_session' => fake()->dateTimeBetween('+0 days','+1 years'),
            'genre' => Genres::getRandomValue(),
            'level' => Levels::getRandomValue(),
            'province' => Provinces::getRandomValue(),
        ];
    }
}
