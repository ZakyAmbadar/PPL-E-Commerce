<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Kosongkan tabel terlebih dahulu
        DB::table('categories')->truncate();

        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik', 'description' => 'Produk elektronik dan gadget'],
            ['name' => 'Fashion Pria', 'slug' => 'fashion-pria', 'description' => 'Pakaian dan aksesoris pria'],
            ['name' => 'Fashion Wanita', 'slug' => 'fashion-wanita', 'description' => 'Pakaian dan aksesoris wanita'],
            ['name' => 'Kesehatan & Kecantikan', 'slug' => 'kesehatan-kecantikan', 'description' => 'Produk kesehatan dan kecantikan'],
            ['name' => 'Rumah Tangga', 'slug' => 'rumah-tangga', 'description' => 'Perabotan dan kebutuhan rumah tangga'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'description' => 'Alat olahraga dan outdoor'],
            ['name' => 'Makanan & Minuman', 'slug' => 'makanan-minuman', 'description' => 'Makanan dan minuman'],
            ['name' => 'Otomotif', 'slug' => 'otomotif', 'description' => 'Sparepart dan aksesori kendaraan'],
            ['name' => 'Hobi & Koleksi', 'slug' => 'hobi-koleksi', 'description' => 'Barang hobi dan koleksi'],
            ['name' => 'Buku & Alat Tulis', 'slug' => 'buku-alat-tulis', 'description' => 'Buku dan alat tulis'],
        ];

        DB::table('categories')->insert($categories);
    }
}