<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role_id' => 1
        ]);

        DB::table('users')->insert([
            'id' => Str::uuid(),
            'name' => 'Bdmin',
            'email' => 'bdmin@example.com',
            'password' => Hash::make('bdmin'),
            'role_id' => 1
        ]);

        User::factory(5)->create();
    }
}
