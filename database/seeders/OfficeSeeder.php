<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::factory(10)
            ->sequence(fn ($sequence) => ['image' => 'office'.($sequence->index+1).'jpg'])
            ->create();
    }
}
