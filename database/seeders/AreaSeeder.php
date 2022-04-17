<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();

        $csvFile = fopen(base_path("areas_dataset/areas.csv"), "r"); 

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Area::create([
                    'id' => $data[0],
                    "name" => $data[1],
                    "city_id" => $data[2],
                ]);    
            }
            $firstline = false;
        }
   
        fclose($csvFile);
    }
}
