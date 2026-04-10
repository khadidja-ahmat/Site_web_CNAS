<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'Admin@artcode.org',
            'password' => Hash::make('Admin123'),
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@artcode.org',
            'password' => Hash::make('user123'),
        ]);
    }
}
