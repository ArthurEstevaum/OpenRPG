<?php

namespace Tests\Feature\Admin\Scenario;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\System;
use App\Models\Scenario;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ScenarioUpdateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_edit_page_can_be_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.scenario.edit', [
            'scenario' => $scenario->id
        ]));

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Admin/Scenario/Edit')
        ->where('scenario.id', $scenario->id)
        ->where('scenario.name', $scenario->name)
        ->where('scenario.system', $scenario->system));
    }

    public function test_non_admins_cannot_access_edit_page() : void
    {
        $user = User::factory()->create();
        $scenario = Scenario::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.scenario.edit', [
            'scenario' => $scenario->id
        ]));

        $response->assertStatus(403);
    }

    public function test_guest_are_redirected_to_login() : void
    {
        $scenario = Scenario::factory()->create();

        $response = $this->get(route('admin.scenario.edit', ['scenario' => $scenario->id]));

        $response->assertRedirect("/login");
    }

    public function test_scenarios_can_be_updated() : void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->create();
        $system = System::factory()->create([
            'name' => 'Dungeons and Dragons'
        ]);

        $response = $this->actingAs($admin)->put(route('admin.scenario.update', [
            'scenario' => $scenario->id,
        ]), [
            'name' => 'Spelljamer',
            'system' => $system->name,
        ]);

        $response->assertRedirect(route('admin.scenario.show', ['scenario' => $scenario->id]));
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('scenarios', [
            'id' => $scenario->id,
            'name' => 'Spelljamer',
            'system_id' => $system->id,
        ]);
    }

    public function test_unauthorized_users_cannot_update_scenarios() : void
    {
        $user = User::factory()->create();
        $scenario  = Scenario::factory()->create();
        $system = System::factory()->create([
            'name' => 'Dungeons and Dragons'
        ]);

        $response = $this->actingAs($user)->put(route('admin.scenario.update', [
            'scenario' => $scenario->id
        ]), [
            'name' => 'Spelljamer',
            'system' => $system->name,
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('scenarios', [
            'id' => $scenario->id,
            'name' => 'Spelljamer',
            'system_id' => $system->id,
        ]);
    }

    /**
     * @dataProvider invalidFormData
     */
    public function test_update_validation_rules_are_working($invalidData, $invalidFields) : void
    {
        $admin = User::factory()->admin()->create();
        $scenario = Scenario::factory()->create();
        System::factory()->create([
            'name' => 'Dungeons and Dragons'
        ]);

        $response = $this->actingAs($admin)->put(route('admin.scenario.update', [
            'scenario' => $scenario->id
        ]), $invalidData);

        $response->assertRedirect();
        $response->assertInvalid($invalidFields);
        //Assert that the scenario record hasn't been updated after request
        $this->assertDatabaseHas('scenarios', [
            'id' => $scenario->id,
            'name' => $scenario->name,
        ]);
    }

    public static function invalidFormData() : array
    {
        return [
            'all fields are empty' => [
                ['name' => null, 'system' => null],
                ['name', 'system']
            ],
            'name field is empty' => [
                ['name' => null, 'system' => 'Dungeons and Dragons'],
                ['name']
            ],
            'system field is empty' => [
                ['name' => 'Spelljamer', 'system' => null],
                ['system']
            ],
            'inexistent system in database' => [
                ['name' => 'Spelljamer', 'system' => 'inexistent'],
                ['system']
            ],
            //Allowed max 255 string length
            'name longer than allowed' => [
                ['name' => '------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------', 'system' => 'Dungeons and Dragons'],
                ['name']
            ],
        ];
    }
}
