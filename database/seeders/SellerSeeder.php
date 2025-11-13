<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    public function run()
    {
         // Kosongkan tabel terlebih dahulu
        DB::table('sellers')->truncate();
        
        $sellers = [
            [
                'store_name' => 'Toko Elektronik Maju Jaya',
                'store_description' => 'Toko elektronik terlengkap dengan harga kompetitif',
                'pic_name' => 'Budi Santoso',
                'pic_phone' => '081234567890',
                'email' => 'budi@tokomajujaya.com',
                'street_address' => 'Jl. Merdeka No. 123',
                'rt_rw' => '001/002',
                'village' => 'Menteng',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'id_card_number' => '1234567890123456',
                'id_card_file' => 'documents/ktp1.jpg',
                'pic_photo' => 'photos/budi.jpg',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_name' => 'Fashion Store Elegant',
                'store_description' => 'Toko fashion modern dengan koleksi terkini',
                'pic_name' => 'Sari Dewi',
                'pic_phone' => '081298765432',
                'email' => 'sari@fashionelegant.com',
                'street_address' => 'Jl. Sudirman No. 456',
                'rt_rw' => '003/004',
                'village' => 'Kebayoran Baru',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'id_card_number' => '2345678901234567',
                'id_card_file' => 'documents/ktp2.jpg',
                'pic_photo' => 'photos/sari.jpg',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_name' => 'Toko Sehat Alami',
                'store_description' => 'Produk kesehatan dan kecantikan alami',
                'pic_name' => 'Ahmad Fauzi',
                'pic_phone' => '082112345678',
                'email' => 'ahmad@tokoalami.com',
                'street_address' => 'Jl. Gatot Subroto No. 789',
                'rt_rw' => '005/006',
                'village' => 'Setiabudi',
                'city' => 'Jakarta Selatan',
                'province' => 'DKI Jakarta',
                'id_card_number' => '3456789012345678',
                'id_card_file' => 'documents/ktp3.jpg',
                'pic_photo' => 'photos/ahmad.jpg',
                'password' => Hash::make('password123'),
                'status' => 'approved',
                'verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_name' => 'Sport Equipment Center',
                'store_description' => 'Peralatan olahraga lengkap dan berkualitas',
                'pic_name' => 'Rina Melati',
                'pic_phone' => '083812345678',
                'email' => 'rina@sportcenter.com',
                'street_address' => 'Jl. Thamrin No. 321',
                'rt_rw' => '007/008',
                'village' => 'Tanah Abang',
                'city' => 'Jakarta Pusat',
                'province' => 'DKI Jakarta',
                'id_card_number' => '4567890123456789',
                'id_card_file' => 'documents/ktp4.jpg',
                'pic_photo' => 'photos/rina.jpg',
                'password' => Hash::make('password123'),
                'status' => 'pending',
                'verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_name' => 'Buku dan Alat Tulis Murah',
                'store_description' => 'Toko buku dan alat tulis dengan harga terjangkau',
                'pic_name' => 'Dewi Sartika',
                'pic_phone' => '084512345678',
                'email' => 'dewi@bukumurah.com',
                'street_address' => 'Jl. Hayam Wuruk No. 654',
                'rt_rw' => '009/010',
                'village' => 'Taman Sari',
                'city' => 'Jakarta Barat',
                'province' => 'DKI Jakarta',
                'id_card_number' => '5678901234567890',
                'id_card_file' => 'documents/ktp5.jpg',
                'pic_photo' => 'photos/dewi.jpg',
                'password' => Hash::make('password123'),
                'status' => 'rejected',
                'verified_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('sellers')->insert($sellers);
    }
}