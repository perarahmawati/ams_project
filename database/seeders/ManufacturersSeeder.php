<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manufacturer;

class ManufacturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manufacturer::create([
            'name' => 'Ixia', 
        ]);

        Manufacturer::create([
            'name' => 'Dell', 
        ]);

        Manufacturer::create([
            'name' => 'Alcatel', 
        ]);
    }
}
