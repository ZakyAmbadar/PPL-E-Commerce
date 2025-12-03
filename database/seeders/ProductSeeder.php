<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->truncate();

        $faker = Faker::create('id_ID');

        $sellers = DB::table('sellers')->pluck('id')->toArray();
        $categoryCount = DB::table('categories')->count();

        $products = [];

        // For each seller create 3-6 products
        foreach ($sellers as $sellerId) {
            $num = $faker->numberBetween(3, 6);
            for ($i = 0; $i < $num; $i++) {
                $catId = $faker->numberBetween(1, max(1, $categoryCount));
                $name = ucfirst($faker->words($faker->numberBetween(2,4), true));
                $products[] = [
                    'name' => $name,
                    'description' => $faker->sentence(10),
                    'price' => $faker->numberBetween(15000, 15000000),
                    'stock' => $faker->numberBetween(0, 100),
                    'weight' => $faker->numberBetween(50, 2000),
                    'category_id' => $catId,
                    'seller_id' => $sellerId,
                    'condition' => $faker->randomElement(['new','used']),
                    'min_order' => 1,
                    'is_active' => $faker->boolean(85),
                    'created_at' => now()->subDays($faker->numberBetween(0,120)),
                    'updated_at' => now(),
                ];
            }
        }

        // Bulk insert in chunks
        $chunks = array_chunk($products, 200);
        foreach ($chunks as $chunk) {
            DB::table('products')->insert($chunk);
        }
    }
}