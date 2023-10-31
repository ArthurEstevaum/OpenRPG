<?php

namespace Database\Seeders;

use App\Models\Tabletop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TabletopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tabletop::factory()->count(25)->create();
    }
}
