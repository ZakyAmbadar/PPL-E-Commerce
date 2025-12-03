<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FullSampleSeeder extends Seeder
{
    /**
     * Run the full, safe re-seed of platform data.
     * This seeder will try to disable foreign key checks when possible,
     * run the platform seeders in order, then re-enable checks.
     */
    public function run()
    {
        $driver = DB::getDriverName();

        // Disable FK checks depending on driver
        if ($driver === 'mysql' || $driver === 'mysqli') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
        } elseif ($driver === 'pgsql') {
            // Postgres: we'll use TRUNCATE ... CASCADE inside each seeder if needed
            // No global toggle available here.
        }

        // Call individual seeders in order
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            CategorySeeder::class,
            AdminSeeder::class,
            SellerSeeder::class,
            ProductSeeder::class,
            ReviewSeeder::class,
        ]);

        // Re-enable FK checks
        if ($driver === 'mysql' || $driver === 'mysqli') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } elseif ($driver === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = ON;');
        }
    }
}
