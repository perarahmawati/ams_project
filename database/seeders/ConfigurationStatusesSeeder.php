<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfigurationStatus;

class ConfigurationStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfigurationStatus::create([
            'name' => 'Unconfigured', 
        ]);

        ConfigurationStatus::create([
            'name' => 'Preconfigured', 
        ]);

        ConfigurationStatus::create([
            'name' => 'Installed', 
        ]);

        ConfigurationStatus::create([
            'name' => 'Configured', 
        ]);

        ConfigurationStatus::create([
            'name' => 'Tested', 
        ]);
    }
}
