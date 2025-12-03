<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        DB::table('reviews')->truncate();

        $faker = Faker::create('id_ID');

        $productIds = DB::table('products')->pluck('id')->toArray();

        $reviews = [];

        // For each product, create 0-8 reviews
        foreach ($productIds as $productId) {
            $num = $faker->numberBetween(0, 8);
            for ($i = 0; $i < $num; $i++) {
                $hasComment = $faker->boolean(80);
                $reviews[] = [
                    'product_id' => $productId,
                    'reviewer_name' => $faker->name,
                    'reviewer_email' => $faker->safeEmail,
                    'reviewer_phone' => $faker->phoneNumber,
                    'rating' => $faker->numberBetween(1, 5),
                    'comment' => $hasComment ? $faker->sentence(10) : null,
                    'is_approved' => true,
                    'created_at' => now()->subDays($faker->numberBetween(0,120)),
                    'updated_at' => now(),
                ];
            }
        }

        $chunks = array_chunk($reviews, 500);
        foreach ($chunks as $chunk) {
            DB::table('reviews')->insert($chunk);
        }
    }
}