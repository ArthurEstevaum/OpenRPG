<?php

namespace Database\Seeders;

use App\Models\Tabletop;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TabletopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tabletop::factory()->count(10)
        ->for(User::factory()->state([
            'name' => 'Master of all tables'
        ]), 'owner_user')
        ->has(User::factory()->count(4))
        ->create();
    }
}
