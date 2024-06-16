<?php

namespace Tests\Feature\Admin\System;

use App\Models\System;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class SystemShowTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_admin_system_can_be_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/sistemas-de-jogo/$system->id");

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/System/Show')
            ->where('system.id', $system->id)
            ->where('system.name', $system->name)
            ->where('system.genre', $system->genre));
    }

    public function test_non_admins_cannot_access_system_page(): void
    {
        $user = User::factory()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($user)->get("/admin/sistemas-de-jogo/$system->id");

        $response->assertStatus(403);
    }

    public function test_guest_are_redirected_to_login(): void
    {
        $system = System::factory()->create();

        $response = $this->get("admin/sistemas-de-jogo/$system->id");

        $response->assertRedirect('/login');
    }
}
