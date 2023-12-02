<?php

namespace Tests\Unit;

use App\Models\Tabletop;
use App\Models\User;
use Database\Seeders\ScenarioSeeder;
use Database\Seeders\SystemSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Checks if the columns of the table are correct.
     */
    public function test_users_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('users', ['id', 'name', 'email', 'admin', 'email_verified_at', 'password',
            'provider_id', 'provider_avatar', 'provider_name', 'remember_token', 'created_at',
            'updated_at'])
        );
    }

    /**
     * Check if the relation between the user which owns
     * the tabletop and the tabletop itself is correct.
     */
    public function test_user_owns_a_tabletop() : void
    {
        $user = User::factory()->create();

        $systemSeeder = new SystemSeeder();
        $systemSeeder->run();

        $scenarioSeeder = new ScenarioSeeder();
        $scenarioSeeder->run();
        
        $tabletop = Tabletop::factory()->create(['owner_user_id' => $user->id]);

        $this->assertTrue($user->owns_tabletops()->get()->contains($tabletop));
    }

    public function test_user_belongs_to_many_tabletops() : void
    {
        $user = User::factory()->create();
        $tabletop = User::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->tabletops()->get());
    }
}
