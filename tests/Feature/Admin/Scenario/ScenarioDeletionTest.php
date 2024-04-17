<?php

namespace Tests\Feature\Admin\Scenario;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Scenario;
use App\Models\System;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ScenarioDeletionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_delete_confirmation_page_can_be_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.scenario.delete', [
            'scenario' => $scenario->id
        ]));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Admin/Scenario/Delete')
        ->where('scenario.id', $scenario->id)
        ->where('scenario.name', $scenario->name));
    }

    public function test_non_admins_cannot_access_delete_confirmation_page() : void
    {
        $user = User::factory()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.scenario.delete', [
            'scenario' => $scenario->id
        ]));

        $response->assertStatus(403);
    }

    public function test_guest_are_redirected_to_login() : void
    {
        $scenario = Scenario::factory()->create();

        $response = $this->get(route('admin.scenario.delete', [
            'scenario' => $scenario->id
        ]));

        $response->assertRedirect("/login");
    }

    public function test_scenarios_can_be_deleted() : void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.scenario.destroy', [
            'scenario' => $scenario->id
        ]));

        $response->assertRedirect(route('admin.scenario.index'));
        $this->assertDatabaseMissing('scenarios', [
            'id' => $scenario->id,
            'name' => $scenario->name
        ]);
    }

    public function test_unauthorized_users_cannot_delete_scenarios() : void
    {
        $user = User::factory()->create();
        $scenario = Scenario::factory()->forSystem()->create();

        $response = $this->actingAs($user)->delete(route('admin.scenario.destroy', [
            'scenario' => $scenario->id
        ]));

        $response->assertStatus(403);
        $this->assertDatabaseHas('scenarios', [
            'id' => $scenario->id,
            'name' => $scenario->name,
            'system_id' => $scenario->system->id,
        ]);
    }
}
