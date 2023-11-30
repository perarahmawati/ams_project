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
        User::create([
            'role' =>'Super Admin',
            'name' => 'Pera Rahmawati', 
            'email' => 'superadmin@gmail.com',
            'phone' => '089671318045',
            'password'=>Hash::make('superadminpw'),
        ]);

        User::create([
            'role' =>'Admin',
            'name' => 'Fuji Anggraeni', 
            'email' => 'admin@gmail.com',
            'phone' => '0881023182562',
            'password'=>Hash::make('adminpw'),
        ]);
    }
}
