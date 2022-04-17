<?php

namespace Database\Seeders;

use App\Models\PriceType;
use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceType::truncate();
        PriceType::create([
            'name' => 'Once'
        ]);
        PriceType::create([
            'name' => 'Hourly'
        ]);
        PriceType::create([
            'name' => 'Daily'
        ]);
        PriceType::create([
            'name' => 'Monthly'
        ]);
        PriceType::create([
            'name' => 'Yearly'
        ]);
        PriceType::create([
            'name' => 'Variable'
        ]);
        

    }
}
