<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) {
            User::create([
                'name'=>'Pera Rahmawati', 
                'email'=>'superadmin@gmail.com',
                'password'=>Hash::make('superadminpw'),
                'role' =>'Super Admin',
            ]);
            $this->command->info('Users table is empty. Successfully seeding.');
        } else {
            $this->command->info('Users table is not empty. Skipping seeding');
        }
    }
}
