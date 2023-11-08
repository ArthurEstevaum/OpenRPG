<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SubgenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Mistério', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aventura', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Guerra', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ação', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Investigação', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Comédia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Horror', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pirataria', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Diplomacia', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Exploração', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table("subgenres")->insert($data);
    }
}
