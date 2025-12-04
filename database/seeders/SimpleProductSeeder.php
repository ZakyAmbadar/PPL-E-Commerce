<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SimpleProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->truncate();
        $faker = Faker::create('id_ID');
        $sellerIds = DB::table('sellers')->pluck('id');
        $categoryIds = DB::table('categories')->pluck('id');

        $products = [];
        $productNames = [
            ['Meja Kayu', 'Meja kayu minimalis cocok untuk ruang tamu atau kerja.'],
            ['Buku Tulis', 'Buku tulis 100 lembar, kertas tebal dan halus.'],
            ['Tas Ransel', 'Tas ransel serbaguna, muat laptop dan perlengkapan sekolah.'],
            ['Sepatu Sneakers', 'Sepatu sneakers nyaman untuk aktivitas harian dan olahraga.'],
            ['Lampu LED', 'Lampu LED hemat energi, terang dan tahan lama.'],
        ];

        foreach ($sellerIds as $sellerId) {
            for ($i = 1; $i <= 5; $i++) {
                $categoryId = $categoryIds[$faker->numberBetween(0, count($categoryIds)-1)];
                $name = $productNames[$i-1][0];
                $desc = $productNames[$i-1][1];
                $products[] = [
                    'name' => $name,
                    'brand' => $faker->randomElement(['Olympic','Sinar Dunia','Eiger','Compass','Philips']),
                    'description' => $desc,
                    'price' => $faker->numberBetween(25000, 350000),
                    'stock' => $faker->numberBetween(5, 50),
                    'weight' => $faker->numberBetween(200, 2000),
                    'category_id' => $categoryId,
                    'seller_id' => $sellerId,
                    'condition' => $faker->randomElement(['new','used']),
                    'min_order' => 1,
                    'is_active' => true,
                    'images' => json_encode($i == 1 ? ['products/kucing.jpg'] : []),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('products')->insert($products);
    }
}
