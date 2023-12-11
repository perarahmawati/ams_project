<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'name' => 'Passive Tapping', 
        ]);

        Item::create([
            'name' => 'NPB', 
        ]);

        Item::create([
            'name' => 'Server', 
        ]);

        Item::create([
            'name' => 'Switch', 
        ]);

        Item::create([
            'name' => 'Storage', 
        ]);

        Item::create([
            'name' => 'Expansion Storage', 
        ]);

        Item::create([
            'name' => 'Firewall', 
        ]);

        Item::create([
            'name' => 'Inverter', 
        ]);

        Item::create([
            'name' => 'Material Installarion', 
        ]);

        Item::create([
            'name' => 'Chasis Tapping', 
        ]);
    }
}
