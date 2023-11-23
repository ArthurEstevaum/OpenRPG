<?php

namespace Tests\Auth\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Mockery\MockInterface;
use Tests\TestCase;

class OAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if users can authenticate through socialite using github
     * as a provider, and also if users are redirected to define their
     * passwords in the first access.
     */
    public function test_users_can_authenticate_using_socialite(): void
    {
        $user = $this->mock('Laravel\Socialite\Contracts\User', function(MockInterface $mock) {
            $mock->id = 123456;
            $mock->name = 'John Doe';
            $mock->email = 'johndoe@test.com';
            $mock->avatar = 'https://lh3.googleusercontent.com/a/ACg8ocLbfEpWnmGoz7UWlmajCfr1hJAfQ2-2ptPkZy2fyQiS=s96-c';
        });

        $provider = $this->mock('Laravel\Socialite\Contracts\Provider', function(MockInterface $mock) use ($user) {
            $mock
                ->shouldReceive('user')
                ->andReturn($user);
        });

        Socialite::shouldReceive('driver')->with('github')->andReturn($provider);

        $response = $this->get('/auth/github/callback');

        $response->assertStatus(302);
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@test.com'
        ]);
        $response->assertRedirectToRoute('define-password');
    }

    /**
     * Test if existent users when logging with socialite are redirected
     * to the home page, since their passwords are already defined.
     */
    public function test_existent_users_are_redirected_to_home_logging_with_socialite() : void
    {
        //Create a user with the same email passed to the mock
        //So when the login process is executed, the user returned
        //by socialite already exists in the database.
        User::factory()->create(['email' => 'johndoe@test.com']);

        $user = $this->mock('Laravel\Socialite\Contracts\User', function(MockInterface $mock) {
            $mock->id = 123456;
            $mock->name = 'John Doe';
            $mock->email = 'johndoe@test.com';
            $mock->avatar = 'https://lh3.googleusercontent.com/a/ACg8ocLbfEpWnmGoz7UWlmajCfr1hJAfQ2-2ptPkZy2fyQiS=s96-c';
        });

        $provider = $this->mock('Laravel\Socialite\Contracts\Provider', function(MockInterface $mock) use ($user) {
            $mock
                ->shouldReceive('user')
                ->andReturn($user);
        });

        Socialite::shouldReceive('driver')->with('github')->andReturn($provider);

        $response = $this->get('/auth/github/callback');

        $response->assertRedirect('/');
    }
}
