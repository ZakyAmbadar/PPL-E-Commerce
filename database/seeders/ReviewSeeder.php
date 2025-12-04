<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        // Komentar ulasan yang relevan dan natural
        $comments = [
            'Produk ini sangat bagus dan sesuai deskripsi.',
            'Kemeja ini bagus sekali, bahannya nyaman.',
            'Kemejanya kekecilan, mohon cek ukuran.',
            'Pengiriman cepat dan produk berkualitas.',
            'Barang sesuai pesanan, recommended!',
            'Sepatunya keren dan nyaman dipakai.',
            'Laptop berfungsi dengan baik, puas!',
            'Buku yang dikirim original dan rapi.',
            'Tas wanita elegan, istri saya suka.',
            'Jaketnya hangat dan modelnya kekinian.',
            'Mainan anak aman dan edukatif.',
            'Masker nyaman dipakai sehari-hari.',
            'Harga terjangkau, kualitas oke.',
            'Produk sesuai gambar, tidak mengecewakan.',
            'Pelayanan penjual ramah dan responsif.',
            'Barang datang tepat waktu, packing aman.',
            'Sandalnya empuk dan tidak licin.',
            'Baju bagus, warna sesuai foto.',
            'Celana jeans pas di badan.',
            'Helm motor kuat dan stylish.',
        ];

        // For each product, create 2-6 reviews
        foreach ($productIds as $productId) {
            $num = $faker->numberBetween(2, 6);
            for ($i = 0; $i < $num; $i++) {
                $reviews[] = [
                    'product_id' => $productId,
                    'reviewer_name' => $faker->name,
                    'reviewer_email' => $faker->safeEmail,
                    'reviewer_phone' => $faker->phoneNumber,
                    'rating' => $faker->numberBetween(3, 5),
                    'comment' => $faker->randomElement($comments),
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