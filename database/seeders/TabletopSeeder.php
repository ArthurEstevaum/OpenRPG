<?php

namespace Database\Seeders;

use App\Models\Tabletop;
use App\Models\User;
use App\Models\Subgenre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $tabletops = Tabletop::all();
        $firstSubgenre = DB::table('subgenres')->first();
        $lastSubgenre = DB::table('subgenres')->orderBy('id','desc')->first();
        $idsArray = range($firstSubgenre->id, $lastSubgenre->id);

        foreach($tabletops as $tabletop) {
            //shuffle the ids array, then assign two Ids to the array.
            //So, two random ids are assigned to each tabletop
            shuffle($idsArray);
            $twoRandomIds = array_slice($idsArray, 0, 2);

            $tabletop->subgenres()->sync($twoRandomIds);
        }
    }
}
