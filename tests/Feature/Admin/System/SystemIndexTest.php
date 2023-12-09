<?php

namespace Tests\Feature\Admin;

use App\Models\System;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\Assert;
use Tests\TestCase;

class SystemTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_admin_system_index_is_displayed(): void
    {
        $admin = User::factory()->admin()->create();
        $systems = System::factory()->count(10);

        $response = $this->actingAs($admin)->get('/admin/sistemas-de-jogo');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Admin/System/Index')
            ->has('system', 5)
        );
    }

    public function test_non_admins_cannot_access_admin_system_index() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/sistemas-de-jogo');

        $response->assertStatus(403);
    }

    public function test_guests_are_redirected_to_login() : void
    {
        $response = $this->get('admin/sistemas-de-jogo');

        $response->assertRedirect('/login');
    }
}
