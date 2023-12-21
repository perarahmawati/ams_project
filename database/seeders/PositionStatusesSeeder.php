<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PositionStatus;

class PositionStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PositionStatus::create([
            'name' => 'Warehouse', 
        ]);

        PositionStatus::create([
            'name' => 'Ondelivery', 
        ]);

        PositionStatus::create([
            'name' => 'Onsite', 
        ]);
    }
}
