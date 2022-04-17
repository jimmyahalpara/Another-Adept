<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceCategory::truncate();
        ServiceCategory::create([
            'name' => 'Plumbing'
        ]);
        ServiceCategory::create([
            'name' => 'HandyMan'
        ]);
        ServiceCategory::create([
            'name' => 'Carpenter'
        ]);
        ServiceCategory::create([
            'name' => 'Wireman'
        ]);
        ServiceCategory::create([
            'name' => 'House Maid'
        ]);
        ServiceCategory::create([
            'name' => 'Haircut'
        ]);
        ServiceCategory::create([
            'name' => 'AC Service'
        ]);

    }
}
