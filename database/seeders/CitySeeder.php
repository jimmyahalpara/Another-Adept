<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();

        $csvFile = fopen(base_path("areas_dataset/cities.csv"), "r"); 

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                City::create([
                    'id' => $data[0],
                    "name" => $data[1],
                    "state" => $data[2],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
