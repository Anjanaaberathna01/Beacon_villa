<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; // Use Admin model
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create an admin user
        Admin::create([
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
        ]);
    }
}
