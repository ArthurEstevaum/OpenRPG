<?php

namespace Tests\Unit;

use App\Models\Scenario;
use App\Models\Subgenre;
use App\Models\System;
use App\Models\Tabletop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TabletopTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Checks if the columns of the table are correct.
     */
    public function test_tabletops_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('tabletops', ['id', 'name', 'created_at', 'updated_at', 'description', 'level', 'genre', 'city', 'province', 'presencial', 'next_session', 'frequency', 'horary',
            'weekday', 'system_id', 'scenario_id', 'owner_user_id'])
        );
    }

    public function test_taletops_belongs_to_a_user() : void
    {
        $user = User::factory()->create();

        $tabletop = Tabletop::factory()->create(['owner_user_id' => $user->id]);

        $this->assertTrue($tabletop->owner_user()->get()->contains($user));
    }

    public function test_tabletops_belongs_to_many_players() : void
    {
        $user = User::factory()->create();

        $tabletop = Tabletop::factory()->create(['owner_user_id' => $user->id]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $tabletop->users()->get());
    }

    public function test_tabletops_belongs_to_a_system() : void
    {
        $user = User::factory()->create();
        $system = System::factory()->create();

        $tabletop = Tabletop::factory()->create(['system_id' => $system->id,
        'owner_user_id' => $user->id]);

        $this->assertTrue($tabletop->system()->get()->contains($system));
    }

    public function test_tabletops_belongs_to_a_scenario() : void
    {
        $user = User::factory()->create();
        $scenario = Scenario::factory()->create();

        $tabletop = Tabletop::factory()->create(['scenario_id' => $scenario->id,
        'owner_user_id' => $user->id]);

        $this->assertTrue($tabletop->scenario()->get()->contains($scenario));
    }
}
