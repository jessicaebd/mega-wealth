<?php

namespace Database\Seeders;

use App\Models\PropertyStatus;
use App\Models\SalesType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PropertyStatusSeeder::class,
            BuildingTypeSeeder::class,
            SalesTypeSeeder::class,
            PropertySeeder::class,
            OfficeSeeder::class
        ]);
        // tapi seeder untuk pivot class(cart)-nya belum
    }
}
