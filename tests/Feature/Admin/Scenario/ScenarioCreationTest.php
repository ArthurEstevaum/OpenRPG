<?php

namespace Tests\Feature\Admin\Scenario;

use App\Models\User;
use App\Models\System;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ScenarioCreationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_creation_form_can_be_displayed_to_admins(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get("/admin/cenarios-de-jogo/criar");

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Admin/Scenario/Create'));
    }

    public function test_non_admins_cannot_access_scenario_creation_form() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/cenarios-de-jogo/criar');

        $response->assertStatus(403);
    }

    public function test_guests_are_redirected_to_login() : void
    {
        $response = $this->get('admin/cenarios-de-jogo/criar');

        $response->assertRedirect('/login');
    }

    public function test_scenarios_can_be_created() : void
    {
        $admin = User::factory()->admin()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($admin)->post('/admin/cenarios-de-jogo', [
            'name' => 'test scenario',
            'system' => $system->name
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('admin.scenario.index'));
        $this->assertDatabaseHas('scenarios', [
            'name' => 'test scenario',
            'system_id' => $system->id,
        ]);
    }

    public function test_unathorized_users_cannot_create_scenarios() : void
    {
        $user = User::factory()->create();
        $system = System::factory()->create();

        $response = $this->actingAs($user)->post('admin/cenarios-de-jogo', [
            'name' => 'test scenario',
            'system' => $system->name,
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('scenarios', [
            'name' => 'test scenario',
            'system_id' => $system->id,
        ]);
    }

    /**
     * @dataProvider invalidFormData
     */
    public function test_store_validation_rules_are_working($invalidData, $invalidFields) : void
    {
        $admin = User::factory()->admin()->create();
        System::factory()->create([
            'name' => 'Dungeons and Dragons'
        ]);

        $response = $this->actingAs($admin)->post(route('admin.scenario.store'), $invalidData);
        
        $response->assertInvalid($invalidFields);
        $response->assertRedirect();
        $this->assertDatabaseEmpty('scenarios');
    }

    public static function invalidFormData() : array
    {
        return [
            'all fields empty' => [
                ['name' => null, 'system' => null],
                ['name', 'system']
            ],
            'empty name' => [
                ['name' => null, 'system' => 'Dungeons and Dragons'],
                ['name']
            ],
            'empty system' => [
                ['name' => 'test name', 'system' => null],
                ['system']
            ],
            'inexistent system in database' => [
                ['name' => 'test name', 'system' => 'inexistent'],
                ['system']
            ],
            //Allowed max 255 string length
            'name longer than allowed' => [
                ['name' => '------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 'system' => 'Dungeons and Dragons'],
                ['name']
            ]
        ];
    }
}