<?php

namespace Tests\Feature\Admin;

use App\Models\System;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class SystemIndexTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_admin_system_index_is_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $systems = System::factory()->count(100);

        $response = $this->actingAs($admin)->get('/admin/sistemas-de-jogo');

        $response->assertStatus(200);
        $response->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Admin/System/Index')
            ->has('systems', fn (AssertableInertia $page) => $page
                ->where('meta.per_page', 12)
                ->has('data')
                ->etc())
        );
    }

    public function test_non_admins_cannot_access_admin_system_index(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/sistemas-de-jogo');

        $response->assertStatus(403);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $response = $this->get('admin/sistemas-de-jogo');

        $response->assertRedirect('/login');
    }
}
