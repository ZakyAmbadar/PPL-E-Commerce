<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class Sample20Seeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $driver = DB::getDriverName();
        if ($driver === 'mysql' || $driver === 'mysqli') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        }

        // Truncate related tables (safe order)
        DB::table('reviews')->truncate();
        DB::table('products')->truncate();
        DB::table('sellers')->truncate();

        $provinces = [
            'DKI Jakarta','Jawa Barat','Jawa Tengah','Jawa Timur','Banten',
            'DI Yogyakarta','Sumatera Utara','Sumatera Barat','Riau','Kalimantan Timur',
            'Kalimantan Barat','Sulawesi Selatan','Bali','Nusa Tenggara Barat','Aceh',
            'Lampung','Bengkulu','Kepulauan Riau','Maluku','Papua'
        ];

        $sellerIds = [];

        // Create 20 sellers
        for ($i = 1; $i <= 20; $i++) {
            $prov = $provinces[array_rand($provinces)];
            $store = $faker->company . ' ' . $faker->randomElement(['Store','Shop','Mart','Outlet']);
            $pic = $faker->name;
            $email = 'seller' . $i . '@example.com';

            $sellerId = DB::table('sellers')->insertGetId([
                'store_name' => $store,
                'store_description' => $faker->sentence(6),
                'pic_name' => $pic,
                'pic_phone' => $faker->phoneNumber,
                'email' => $email,
                'street_address' => $faker->streetAddress,
                'rt_rw' => sprintf('%03d/%03d', $faker->numberBetween(1, 150), $faker->numberBetween(1, 150)),
                'village' => $faker->cityPrefix . ' ' . $faker->city,
                'city' => $faker->city,
                'province' => $prov,
                'id_card_number' => $faker->numerify('################'),
                'id_card_file' => 'documents/ktp_placeholder.jpg',
                'pic_photo' => 'photos/pic_placeholder.jpg',
                'password' => Hash::make('password123'),
                'status' => $faker->randomElement(['approved','pending','rejected']),
                'verified_at' => now()->subDays($faker->numberBetween(0,30)),
                'created_at' => now()->subDays($faker->numberBetween(1,120)),
                'updated_at' => now(),
            ]);

            $sellerIds[] = $sellerId;

            // For each seller, create 5-8 products
            $numProducts = $faker->numberBetween(5, 8);
            for ($p = 0; $p < $numProducts; $p++) {
                // choose random existing category id (fallback to 1)
                $categoryId = DB::table('categories')->inRandomOrder()->value('id') ?? 1;

                $productId = DB::table('products')->insertGetId([
                    'name' => ucfirst($faker->words($faker->numberBetween(2,4), true)),
                    'description' => $faker->sentence(10),
                    'price' => $faker->numberBetween(15000, 15000000),
                    'stock' => $faker->numberBetween(0, 100),
                    'weight' => $faker->numberBetween(50, 2000),
                    'category_id' => $categoryId,
                    'seller_id' => $sellerId,
                    'condition' => $faker->randomElement(['new','used']),
                    'min_order' => 1,
                    'is_active' => true,
                    'created_at' => now()->subDays($faker->numberBetween(0,120)),
                    'updated_at' => now(),
                ]);

                // For each product create 1-5 reviews
                $numReviews = $faker->numberBetween(1, 5);
                for ($r = 0; $r < $numReviews; $r++) {
                    DB::table('reviews')->insert([
                        'product_id' => $productId,
                        'reviewer_name' => $faker->name,
                        'reviewer_email' => $faker->safeEmail,
                        'reviewer_phone' => $faker->phoneNumber,
                        'rating' => $faker->numberBetween(1, 5),
                        'comment' => $faker->sentence(8),
                        'is_approved' => true,
                        'created_at' => now()->subDays($faker->numberBetween(0,120)),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        if ($driver === 'mysql' || $driver === 'mysqli') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }
}
