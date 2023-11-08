<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tabletop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)
        ->create();
        User::factory()->count(1)->admin()->create();
    }
}
