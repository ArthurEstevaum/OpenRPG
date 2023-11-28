<?php

namespace Tests\Unit;

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
}
