<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel terlebih dahulu
        DB::table('reviews')->truncate();

        $reviews = [
            // Review untuk produk 1 (Smartphone)
            [
                'product_id' => 1,
                'reviewer_name' => 'Andi Wijaya',
                'reviewer_email' => 'andi@email.com',
                'reviewer_phone' => '08111222333',
                'rating' => 5,
                'comment' => 'Produk sangat bagus, pengiriman cepat!',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'reviewer_name' => 'Siti Rahayu',
                'reviewer_email' => 'siti@email.com',
                'reviewer_phone' => '08222333444',
                'rating' => 4,
                'comment' => 'Kualitas baik, harga worth it',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Review untuk produk 2 (Laptop)
            [
                'product_id' => 2,
                'reviewer_name' => 'Rudi Hermawan',
                'reviewer_email' => 'rudi@email.com',
                'reviewer_phone' => '08333444555',
                'rating' => 5,
                'comment' => 'Laptop cepat dan ringan, cocok untuk kerja',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Review untuk produk 3 (Headphone)
            [
                'product_id' => 3,
                'reviewer_name' => 'Maya Sari',
                'reviewer_email' => 'maya@email.com',
                'reviewer_phone' => '08444555666',
                'rating' => 3,
                'comment' => 'Noise cancelling oke, tapi baterai kurang tahan lama',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Review untuk produk 4 (Kemeja)
            [
                'product_id' => 4,
                'reviewer_name' => 'Bambang Sutrisno',
                'reviewer_email' => 'bambang@email.com',
                'reviewer_phone' => '08555666777',
                'rating' => 4,
                'comment' => 'Bahan nyaman, ukuran sesuai',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Review untuk produk 5 (Dress)
            [
                'product_id' => 5,
                'reviewer_name' => 'Diana Putri',
                'reviewer_email' => 'diana@email.com',
                'reviewer_phone' => '08666777888',
                'rating' => 5,
                'comment' => 'Warna cantik dan bahan adem!',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Review untuk produk 6 (Vitamin C)
            [
                'product_id' => 6,
                'reviewer_name' => 'Hendra Kurniawan',
                'reviewer_email' => 'hendra@email.com',
                'reviewer_phone' => '08777888999',
                'rating' => 4,
                'comment' => 'Kualitas baik, packaging rapi',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('reviews')->insert($reviews);
    }
}