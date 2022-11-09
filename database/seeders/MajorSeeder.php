<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Major::truncate();
        $majors = ["informatika", "marketing", "CDM","akutansi"];
        foreach ($majors as $key => $major){
            Major::create([
                "name" => $major,
                "description" => "Ini jurusan $major"
            ]);
        }
    }
}
