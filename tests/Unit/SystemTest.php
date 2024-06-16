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

class SystemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Checks if the columns of the table are correct..
     */
    public function test_system_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('systems', ['id', 'name', 'created_at', 'updated_at', 'genre'])
        );
    }

    public function test_system_has_many_tabletops(): void
    {
        $user = User::factory()->create();

        $system = System::factory()->create();
        $tabletop = Tabletop::factory()->create(['owner_user_id' => $user->id,
            'system_id' => $system->id]);

        $this->assertTrue($system->tabletops()->get()->contains($tabletop));
    }

    public function test_system_has_many_scenarios(): void
    {
        $system = System::factory()->create();
        $scenario = Scenario::factory()->create(['system_id' => $system->id]);

        $this->assertTrue($system->scenarios()->get()->contains($scenario));
    }
}
