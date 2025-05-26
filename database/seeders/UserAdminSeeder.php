<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'Pelanggan 1',
                'email' => 'pelanggan1@pelanggan.com',
                'password' => Hash::make('pelanggan1'),
                'role' => 'pelanggan',
            ],
        ]);
    }
}
