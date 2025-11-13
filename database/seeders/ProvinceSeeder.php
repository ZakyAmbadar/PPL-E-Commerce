<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            ['name' => 'DKI Jakarta'],
            ['name' => 'Jawa Barat'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'Jawa Timur'],
            ['name' => 'Banten'],
            ['name' => 'DI Yogyakarta'],
            ['name' => 'Bali'],
            ['name' => 'Sumatera Utara'],
            ['name' => 'Sumatera Barat'],
            ['name' => 'Riau'],
        ];

        DB::table('provinces')->insert($provinces);
    }
}