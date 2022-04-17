<?php

namespace Database\Seeders;

use App\Models\InvoiceState;
use Illuminate\Database\Seeder;

class InvoiceStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InvoiceState::truncate();
        InvoiceState::create([
            'name' => 'Unpaid'
        ]);
        InvoiceState::create([
            'name' => 'Paid'
        ]);
    }
}
