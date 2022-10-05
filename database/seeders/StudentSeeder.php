<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::truncate();
        //local factory in indonesia
        $faker = Factory::create('id_ID');
        //panggil semua jurusan
        $majors = Major::get();
        for ($i=0; $i <100; $i++){
            $gender= ($i %2)? "male":"female";
            Student::create([
                "name" => $faker->name($gender),
                "date_birth" => "2000-12-20",
                "gender" => $gender,
                "address" => $faker->address,
                "major_id" => $majors->random()->id
            ]);
        }
    }
}
