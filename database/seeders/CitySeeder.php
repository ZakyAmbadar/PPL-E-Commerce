<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            // DKI Jakarta
            ['name' => 'Jakarta Pusat', 'province_id' => 1],
            ['name' => 'Jakarta Selatan', 'province_id' => 1],
            ['name' => 'Jakarta Barat', 'province_id' => 1],
            ['name' => 'Jakarta Timur', 'province_id' => 1],
            ['name' => 'Jakarta Utara', 'province_id' => 1],
            
            // Jawa Barat
            ['name' => 'Bandung', 'province_id' => 2],
            ['name' => 'Bekasi', 'province_id' => 2],
            ['name' => 'Bogor', 'province_id' => 2],
            ['name' => 'Depok', 'province_id' => 2],
            ['name' => 'Cimahi', 'province_id' => 2],
            
            // Jawa Tengah
            ['name' => 'Semarang', 'province_id' => 3],
            ['name' => 'Surakarta', 'province_id' => 3],
            ['name' => 'Salatiga', 'province_id' => 3],
            ['name' => 'Pekalongan', 'province_id' => 3],
            ['name' => 'Tegal', 'province_id' => 3],
            
            // Jawa Timur
            ['name' => 'Surabaya', 'province_id' => 4],
            ['name' => 'Malang', 'province_id' => 4],
            ['name' => 'Kediri', 'province_id' => 4],
            ['name' => 'Blitar', 'province_id' => 4],
            ['name' => 'Madiun', 'province_id' => 4],
        ];

        DB::table('cities')->insert($cities);
    }
}