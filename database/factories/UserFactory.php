<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function socialiteGoogle() : static
    {
        return $this->state(fn (array $attributes) => [
            'password' => null,
            'provider_id' => random_int(1, 1000),
            'provider_name' => 'google',
            'provider_avatar' => 'https://lh3.googleusercontent.com/a/ACg8ocL_gjb8WxHCgn77qq6179TkiQNhzbq3Nw7K9haMs3vf=s96-c'
        ]);
    }

    public function socialiteGithub() : static
    {
        return $this->state(fn (array $attributes) => [
            'password' => null,
            'provider_id' => random_int(1, 1000),
            'provider_name' => 'github',
            'provider_avatar' => 'https://avatars.githubusercontent.com/u/91440878?v=4'
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Arthur Estevão',
            'admin' => 1,
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD')
        ]);
    }
}
