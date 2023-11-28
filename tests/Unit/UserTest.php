<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
            'updated_at']), 1
        );
    }
}
