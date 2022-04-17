<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderState::truncate();
        OrderState::create([
            'id' => 1,
            'name' => 'Placed',
            'description' => 'Order Placed'
        ]);
        OrderState::create([
            'id' => 2,
            'name' => 'Assigned',
            'description' => 'Order Assigned'
        ]);
        OrderState::create([
            'id' => 3,
            'name' => 'Cancelled',
            'description' => 'Order Cancelled'
        ]);
        OrderState::create([
            'id' => 4,
            'name' => 'Rejected',
            'description' => 'Order Rejected'
        ]);
        OrderState::create([
            'id' => 5,
            'name' => 'Hold',
            'description' => 'Order On Hold'
        ]);
        OrderState::create([
            'id' => 6,
            'name' => 'Completed',
            'description' => 'Order Completed'
        ]);
    }
}
