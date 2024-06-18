<?php

namespace Tests\Feature\Admin\System;

use App\Models\System;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class SystemDeletionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_delete_confirmation_page_can_be_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/sistemas-de-jogo/$system->id/excluir");

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/System/Delete')
            ->has('system')
            ->where('system.id', $system->id)
            ->where('system.name', $system->name));
    }

    public function test_non_admins_cannot_access_delete_confirmation_page(): void
    {
        $user = User::factory()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($user)->get("/admin/sistemas-de-jogo/$system->id/excluir");

        $response->assertStatus(403);
    }

    public function test_guest_are_redirected_to_login(): void
    {
        $system = System::factory()->create();

        $response = $this->get("admin/sistemas-de-jogo/$system->id/excluir");

        $response->assertRedirect('/login');
    }

    public function test_systems_can_be_deleted(): void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->delete("/admin/sistemas-de-jogo/$system->id");

        $response->assertRedirect(route('admin.system.index'));
        $this->assertDatabaseMissing('systems', [
            'id' => $system->id,
        ]);
    }

    public function test_unauthorized_users_cannot_delete_systems(): void
    {
        $user = User::factory()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($user)->delete("admin/sistemas-de-jogo/$system->id");

        $response->assertStatus(403);
        $this->assertDatabaseHas('systems', [
            'id' => $system->id,
            'name' => $system->name,
            'genre' => $system->genre,
        ]);
    }
}
