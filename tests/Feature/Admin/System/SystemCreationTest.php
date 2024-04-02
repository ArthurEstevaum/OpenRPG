<?php

namespace Tests\Feature\Admin\System;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class SystemCreationTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_admin_system_create_form_is_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        
        $response = $this->actingAs($admin)->get('/admin/sistemas-de-jogo/criar');

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Admin/System/Create'));
    }

    public function test_non_admins_cannot_access_admin_system_index() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/sistemas-de-jogo/criar');

        $response->assertStatus(403);
    }

    public function test_guests_are_redirected_to_login() : void
    {
        $response = $this->get('admin/sistemas-de-jogo/criar');

        $response->assertRedirect('/login');
    }

    public function test_systems_can_be_created() : void
    {
        $admin = User::factory()->admin()->create();
        $response = $this->actingAs($admin)->post('/admin/sistemas-de-jogo', [
            'name' => 'test',
            'genre' => 'Medieval Fantasy',
        ]);

        $response->assertRedirect('/admin/sistemas-de-jogo');
        $this->assertDatabaseHas('systems', [
            'name' => 'test',
            'genre' => 'Medieval Fantasy',
        ]);
    }

    public function test_unauthorized_users_cannot_create_system() : void
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post('admin/sistemas-de-jogo', [
            'name' => 'test',
            'genre' => 'Medieval Fantasy',
        ]);

        $response->assertStatus(403);
    }

    public function test_system_validation_throws_error_when_invalid_genre_input() : void
    {

    }

    public function test_system_validation_throws_error_when_invalid_name_input() : void
    {
        
    }
}
