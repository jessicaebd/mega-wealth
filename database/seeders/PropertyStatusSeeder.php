<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_statuses')->insert([
            'name' => 'open'
        ]);
        
        DB::table('property_statuses')->insert([
            'name' => 'added to cart'
        ]);

        DB::table('property_statuses')->insert([
            'name' => 'completed'
        ]);
    }
}
