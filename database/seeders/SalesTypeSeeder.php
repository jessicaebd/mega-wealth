<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales_types')->insert([
            'name' => 'rent'
        ]);
        
        DB::table('sales_types')->insert([
            'name' => 'buy'
        ]);
    }
}
