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
            'name'=>'Pera Rahmawati', 
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make('superadminpw'),
            'telp'=>'0812345678910',
            'role' =>'Super Admin',
        ]);
    }
}
