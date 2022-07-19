<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // untuk property yg statusnya completed
        foreach (Property::where('property_status_id', 3)->get() as $property) {
            // admin tidak bisa punya transaction
            $user = User::where('role_id', '!=', 1)->get()->random();
            
            DB::table('transactions')->insert([
                'id' => Str::uuid(),
                'transaction_date' => now(),
                'location' => $property->location,
                'price' => $property->price,
                'image' => $property->image,
                'building_type_id' => $property->buildingType->id,
                'sales_type_id' => $property->salesType->id,
                'user_id' => $user->id,
                'property_id' => $property->id
            ]);
        }
    }
}
