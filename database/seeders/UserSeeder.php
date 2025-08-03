<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'Fname' => 'Yasmeen',
                'Lname' => 'Abuzaid',
                'email' => 'yasmeenabuzaid552@gmail.com',
                'email_verified_at' => now(),
                'role' => 'manager',
                'mobile' => '0791234567',
                'password' => Hash::make('yasmeenabuzaid552@gmail.com'),
                'isDelete' => false,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
