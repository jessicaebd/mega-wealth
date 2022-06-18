<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::factory(25)
            ->randPropertyStatus()
            ->randBuildingType()
            ->randSalesType()
            ->sequence(fn ($sequence) => ['image' => 'property'.($sequence->index+1).'jpg'])
            ->create();

        foreach (Property::all() as $property) {
            $maxUser = User::count() - 2; // jumlah admin
            $addedUsers = rand(0, $maxUser);
            
            $users = User::where('role_id', '!=', 1)->get()->random($addedUsers);
            
            foreach ($users as $user) {
                $property->users()->attach($user->id, ['add_date' => now()]);
            }
        }
    }
}
