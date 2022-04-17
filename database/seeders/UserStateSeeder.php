<?php

namespace Database\Seeders;

use App\Models\UserState;
use Illuminate\Database\Seeder;

class UserStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserState::truncate();
        UserState::create([
            'name' => 'Active',
            'description' => 'User is Active'
        ]);

        UserState::create([
            'name' => 'Inactive',
            'description' => 'User is Inactive'
        ]);
    }
}
