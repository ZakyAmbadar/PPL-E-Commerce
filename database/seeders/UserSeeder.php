<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat user untuk setiap seller1@example.com dst
        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $users[] = [
                'name' => 'Seller ' . $i,
                'email' => 'seller' . $i . '@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('users')->insert($users);
    }
}
