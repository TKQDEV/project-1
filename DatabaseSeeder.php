<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Gọi các Seeder
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);
    }
}

