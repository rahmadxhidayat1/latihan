<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    //memanggil class seeder yang dijalankan
     public function run()
    {
        $this->call([
            MajorSeeder::class,
            StudentSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}
