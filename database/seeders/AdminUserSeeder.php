<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Note: Default password is 'password123' for initial setup
        // For production, change this password immediately after first login
        \App\Models\AdminUser::create([
            'name' => 'Admin',
            'email' => 'admin@shadesoftx.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'super_admin',
        ]);
    }
}
