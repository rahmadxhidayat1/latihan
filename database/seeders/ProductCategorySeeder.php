<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $faker = Factory::create();
            $category = ["accessories" ,"components" ,"software" ,"Electronics"];
            foreach ($category as $key => $categories) {
                ProductCategory::create([
                    "name" => $categories,
                    "status" => $faker->randomElement(['active','inactive']),
                    "description" => $faker->paragraph()
                ]);
            }
        }
    }
}
