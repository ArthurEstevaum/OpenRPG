<?php

namespace Tests\Feature\Admin\System;

use App\Models\System;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class SystemUpdateTest extends TestCase
{

    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_edit_page_can_be_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/sistemas-de-jogo/$system->id/editar");

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Admin/System/Edit')
        ->has('system', 1)
        ->where('system.id', $system->id)
        ->where('system.name', $system->name)
        ->where('system.genre', $system->genre));
    }

    public function test_non_admins_cannot_access_edit_page() : void
    {
        $user = User::factory()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($user)->get("/admin/sistemas-de-jogo/$system->id/editar");

        $response->assertStatus(403);
    }

    public function test_guest_are_redirected_to_login() : void
    {
        $system = System::factory()->create();

        $response = $this->get("admin/sistemas-de-jogo/$system->id/editar");

        $response->assertRedirect("/login");
    }

    public function test_systems_can_be_updated() : void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->put("admin/sistemas-de-jogo/$system->id", [
            'name' => 'Dungeons and Dragons',
            'genre' => 'Fantasia Medieval',
        ]);

        $response->assertRedirect("/admin/sistemas-de-jogo/$system->id");
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('systems', [
            'id' => $system->id,
            'name' => 'Dungeons and Dragons',
            'genre' => 'Fantasia Medieval',
        ]);
    }

    public function test_unauthorized_users_cannot_update_systems() : void
    {
        $user = User::factory()->create();
        $system  = System::factory()->create();

        $response = $this->actingAs($user)->put("/admin/sistemas-de-jogo/$system->id", [
            'name' => 'Dungeons and Dragons',
            'genre' => 'Fantasia Medieval',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('systems', [
            'name' => 'Dungeons and Dragons',
            'genre' => 'Fantasia Medieval',
        ]);
    }

    public function test_system_validation_throws_error_when_invalid_inputs() : void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->put("/admin/sistemas-de-jogo/$system->id", [
            'genre' => 'aleatory genre',
        ]);

        $response->assertInvalid(['name', 'genre']);
    }
}