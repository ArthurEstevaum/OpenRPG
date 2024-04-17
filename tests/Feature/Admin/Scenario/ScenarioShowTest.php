<?php

namespace Tests\Feature\Admin\Scenario;

use App\Models\Scenario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ScenarioShowTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_scenario_page_can_be_displayed_for_admins(): void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/cenarios-de-jogo/$scenario->id");

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Admin/Scenario/Show')
        ->where('scenario.id', $scenario->id)
        ->where('scenario.name', $scenario->name)
        ->where('scenario.system', $scenario->system));
    }

    public function test_non_admins_cannot_access_system_page() : void
    {
        $user = User::factory()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($user)->get("/admin/cenarios-de-jogo/$scenario->id");

        $response->assertStatus(403);
    }

    public function test_guest_are_redirected_to_login() : void
    {
        $scenario = Scenario::factory()->create();

        $response = $this->get("admin/cenarios-de-jogo/$scenario->id");

        $response->assertRedirect("/login");
    }
}
