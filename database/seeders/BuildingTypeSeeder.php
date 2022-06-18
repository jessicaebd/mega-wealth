<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('building_types')->insert([
            'name' => 'apartment'
        ]);
        
        DB::table('building_types')->insert([
            'name' => 'house'
        ]);
    }
}
