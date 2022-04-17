<?php

namespace Database\Seeders;

use App\Models\OrganizationState;
use Illuminate\Database\Seeder;

class OrganizationStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrganizationState::truncate();
        OrganizationState::create([
            'name' => 'InActive',
            'description' => 'In Active'
        ]);
        OrganizationState::create([
            'name' => 'Active',
            'description' => 'Active'
        ]);
    }
}
