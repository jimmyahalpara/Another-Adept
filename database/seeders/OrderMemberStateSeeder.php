<?php

namespace Database\Seeders;

use App\Models\OrderMemberState;
use Illuminate\Database\Seeder;

class OrderMemberStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderMemberState::truncate();
        OrderMemberState::create([
            'name' => 'InComplete',
            'description' => 'Order is not completed by Provider',
        ]);
        OrderMemberState::create([
            'name' => 'Complete',
            'description' => 'Order is completed by Provier',
        ]);
    }
}
