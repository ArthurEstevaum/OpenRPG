<?php

namespace Tests\Unit;

use App\Models\Subgenre;
use App\Models\Tabletop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class SubgenreTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /**
     * Checks if the columns of the table are correct.
     */
    public function test_subgenre_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('subgenres', ['id', 'name', 'created_at', 'updated_at'])
        );
    }

    public function test_subgenre_belongs_to_many_tabletops() : void
    {
        $user = User::factory()->create();

        $tabletop = Tabletop::factory()->create(['owner_user_id' => $user->id]);
        $subgenre = Subgenre::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $subgenre->tabletops()->get());
    }
}
