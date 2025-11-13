<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Hapus baris DB::table('admins')->truncate(); karena tabel mungkin belum ada
        
        $admins = [
            [
                'name' => 'Administrator',
                'email' => 'admin@marketplace.com',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manager Platform',
                'email' => 'manager@marketplace.com', 
                'password' => Hash::make('password123'),
                'role' => 'manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('admins')->insert($admins);
    }
}