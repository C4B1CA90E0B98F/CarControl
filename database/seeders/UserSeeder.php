<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'role' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'role' => 'Approver',
            'username' => 'Approver1',
            'email' => 'Approver1@test.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'role' => 'Approver',
            'username' => 'Approver2',
            'email' => 'approver2@test.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
