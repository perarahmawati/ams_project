<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role_name' => 1,
            'name' => 'Pera Rahmawati', 
            'email' => 'superadmin@gmail.com',
            'phone' => '089671318045',
            'password'=>Hash::make('superadminpw'),
        ]);
    }
}
