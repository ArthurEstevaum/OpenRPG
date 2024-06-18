<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordDefinitionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_define_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/define-password');

        $response->assertStatus(200);
    }

    public function test_users_without_password_can_define_a_password(): void
    {
        //The user created by factory has the socialiteGoogle state because
        //users created with socialite doesn't have a password defined
        //by default, so their password are null until they define the password.
        $user = User::factory()->socialiteGoogle()->create();

        $response = $this->actingAs($user)->put('/define-password', ['password' => 'password',
            'password_confirmation' => 'password']);

        $this->assertTrue(Hash::check('password', $user->password));
        $response->assertRedirect('/');
        $response->assertSessionHasNoErrors();
    }

    public function test_users_with_password_cannot_define_a_password(): void
    {
        $user = User::factory()->create();
        $userPasswordBeforeRequest = $user->password;

        $response = $this->actingAs($user)->put('/define-password', ['password' => 'password',
            'password_confirmation' => 'password']);

        //The reason for this assertion is to ensure the user password
        //has not changed after the request to 'define-password' route
        $this->assertEquals($userPasswordBeforeRequest, $user->password);
        $response->assertRedirect('/define-password');
        $response->assertSessionHas('error', 'A senha já está definida');
    }
}
