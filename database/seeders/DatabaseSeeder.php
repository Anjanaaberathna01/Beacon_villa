<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{


    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin29149@gmail.com',
            'password' => Hash::make('admin29149'),
            'role' => 'admin',
        ]);
    }

}