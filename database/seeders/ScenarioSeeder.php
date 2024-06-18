<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScenarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Golarion', 'system_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mestres de Zansara', 'system_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Forgotten Realms', 'system_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dragonlance', 'system_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ravenloft', 'system_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Greyhawk', 'system_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mystara', 'system_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arton', 'system_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Future Golarion', 'system_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Night City', 'system_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'World of Tephra', 'system_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'World of Darkness', 'system_id' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lovecraft World', 'system_id' => 8, 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('scenarios')->insert($data);
    }
}
