<?php

namespace Tests\Unit;

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
}
