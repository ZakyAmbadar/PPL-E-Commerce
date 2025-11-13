<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Produk Elektronik - Seller 1
            [
                'name' => 'Smartphone Samsung Galaxy S21',
                'description' => 'Smartphone flagship dengan kamera 108MP dan processor terbaru',
                'price' => 8999000,
                'stock' => 15,
                'weight' => 200,
                'category_id' => 1, // Pastikan category_id 1 ada
                'seller_id' => 1,   // Pastikan seller_id 1 ada
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Laptop ASUS VivoBook 15',
                'description' => 'Laptop tipis dan ringan untuk kerja dan kuliah',
                'price' => 7499000,
                'stock' => 8,
                'weight' => 1500,
                'category_id' => 1,
                'seller_id' => 1,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Headphone Sony WH-1000XM4',
                'description' => 'Headphone noise cancelling dengan kualitas suara terbaik',
                'price' => 3499000,
                'stock' => 20,
                'weight' => 250,
                'category_id' => 1,
                'seller_id' => 1,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Produk Fashion - Seller 2
            [
                'name' => 'Kemeja Pria Lengan Panjang',
                'description' => 'Kemeja formal bahan katun premium untuk kerja',
                'price' => 249000,
                'stock' => 50,
                'weight' => 300,
                'category_id' => 2,
                'seller_id' => 2,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dress Wanita Casual',
                'description' => 'Dress casual untuk sehari-hari dengan bahan nyaman',
                'price' => 189000,
                'stock' => 35,
                'weight' => 250,
                'category_id' => 3,
                'seller_id' => 2,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Produk Kesehatan - Seller 3
            [
                'name' => 'Vitamin C 1000mg',
                'description' => 'Suplemen vitamin C untuk daya tahan tubuh',
                'price' => 75000,
                'stock' => 100,
                'weight' => 100,
                'category_id' => 4,
                'seller_id' => 3,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Face Serum Vitamin C',
                'description' => 'Serum wajah untuk mencerahkan dan melembabkan kulit',
                'price' => 120000,
                'stock' => 60,
                'weight' => 30,
                'category_id' => 4,
                'seller_id' => 3,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Produk dengan stock rendah
            [
                'name' => 'Smart Watch Fitness Tracker',
                'description' => 'Smartwatch untuk monitoring kesehatan dan fitness',
                'price' => 499000,
                'stock' => 1,
                'weight' => 50,
                'category_id' => 1,
                'seller_id' => 1,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tas Ransel Pria',
                'description' => 'Tas ransel untuk kerja dan travel',
                'price' => 299000,
                'stock' => 0,
                'weight' => 500,
                'category_id' => 2,
                'seller_id' => 2,
                'condition' => 'new',
                'min_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}