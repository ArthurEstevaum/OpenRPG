<?php

namespace Tests\Unit;

use App\Models\Scenario;
use App\Models\System;
use App\Models\Tabletop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ScenarioTest extends TestCase
{

    use RefreshDatabase, WithFaker;

     /**
     * Checks if the columns of the table are correct.
     */
    public function test_scenario_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('scenarios', ['id', 'name', 'created_at', 'updated_at', 'system_id'])
        );
    }

    public function test_scenario_has_many_tabletops() : void
    {
        $user = User::factory()->create();

        $scenario = Scenario::factory()->create();
        $tabletop = Tabletop::factory()->create([
            'owner_user_id' => $user->id,
            'scenario_id' => $scenario->id,
        ]);

        $this->assertTrue($scenario->tabletops()->get()->contains($tabletop));
    }

    public function test_scenario_belongs_to_a_system() : void
    {
        $system = System::factory()->create();

        $scenario = Scenario::factory()->create(['system_id' => $system->id]);

        $this->assertTrue($scenario->system()->get()->contains($system));
    }
}
