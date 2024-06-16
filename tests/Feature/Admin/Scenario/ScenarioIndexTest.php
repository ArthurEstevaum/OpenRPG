<?php

namespace Tests\Feature\Admin\Scenario;

use App\Models\Scenario;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ScenarioIndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_admin_scenario_index_is_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->count(100);

        $response = $this->actingAs($admin)->get('/admin/cenarios-de-jogo');

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/Scenario/Index')
            ->has('scenarios', fn (AssertableInertia $page) => $page
                ->where('meta.per_page', 12)
                ->has('data')
                ->etc())
        );
    }

    public function test_non_admins_cannot_access_admin_scenario_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/cenarios-de-jogo');

        $response->assertStatus(403);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $response = $this->get('admin/cenarios-de-jogo');

        $response->assertRedirect('/login');
    }
}
