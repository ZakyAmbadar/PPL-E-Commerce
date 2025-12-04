<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SellerSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel terlebih dahulu
        DB::table('sellers')->truncate();

        $faker = Faker::create('id_ID');

        // Representative list of Indonesian provinces to distribute sellers
        $provinces = [
            'DKI Jakarta','Jawa Barat','Jawa Tengah','Jawa Timur','Banten',
            'DI Yogyakarta','Sumatera Utara','Sumatera Barat','Riau','Kalimantan Timur',
            'Kalimantan Barat','Sulawesi Selatan','Bali','Nusa Tenggara Barat','Aceh',
            'Lampung','Bengkulu','Kepulauan Riau','Maluku','Papua'
        ];

        $sellers = [];

        // Generate 20 sellers distributed across provinces
        for ($i = 1; $i <= 20; $i++) {
            $prov = $provinces[array_rand($provinces)];
            $store = $faker->company . ' ' . $faker->randomElement(['Store','Shop','Mart','Outlet']);
            $pic = $faker->name;
            $email = 'seller' . $i . '@example.com';

            // Cari user dengan email yang sama, jika ada
            $user = DB::table('users')->where('email', $email)->first();
            $userId = $user ? $user->id : null;

            $sellers[] = [
                'user_id' => $userId,
                'store_name' => $store,
                'store_description' => $faker->sentence(6),
                'pic_name' => $pic,
                'pic_phone' => $faker->phoneNumber,
                'email' => $email,
                'street_address' => $faker->streetAddress,
                'rt_rw' => sprintf('%03d/%03d', $faker->numberBetween(1, 150), $faker->numberBetween(1, 150)),
                'village' => 'Desa ' . $faker->city,
                'city' => $faker->city,
                'province' => $prov,
                'id_card_number' => $faker->numerify('################'),
                'id_card_file' => 'documents/ktp_placeholder.jpg',
                'pic_photo' => 'photos/pic_placeholder.jpg',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'verified_at' => now()->subDays($faker->numberBetween(0,30)),
                'created_at' => now()->subDays($faker->numberBetween(1,120)),
                'updated_at' => now(),
            ];
        }

        DB::table('sellers')->insert($sellers);
    }
}