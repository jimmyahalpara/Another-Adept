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
    public function run()
    {
        $this -> call(UserStateSeeder::class);
        $this -> call(ServiceCategorySeeder::class);
        $this -> call(PriceTypeSeeder::class);
        $this -> call(OrganizationStateSeeder::class);
        $this -> call(OrderStateSeeder::class);
        $this -> call(OrderMemberStateSeeder::class);
        $this -> call(InvoiceStateSeeder::class);
        $this -> call(CitySeeder::class);
        $this -> call(AreaSeeder::class);
    }
}
