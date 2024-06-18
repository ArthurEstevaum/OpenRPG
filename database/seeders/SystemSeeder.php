<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = [
            ['name' => 'Dungeons and Dragons', 'genre' => 'Fantasia Medieval', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pathfinder', 'genre' => 'Fantasia Medieval', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tormenta 20', 'genre' => 'Fantasia Medieval', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Starfinder', 'genre' => 'Sci-fi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cyberpunk 2020', 'genre' => 'Sci-fi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tephra', 'genre' => 'Steampunk', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vampire Masquerade', 'genre' => 'Fantasia Sombria', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Call of Cthulhu', 'genre' => 'Fantasia Sombria', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('systems')->insert($data);
        System::factory()->count(64)->create();
    }
}
