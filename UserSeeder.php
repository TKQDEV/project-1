<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tạo người dùng Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('abc12345'), // Mã hóa mật khẩu
            'role' => 'admin', // Vai trò admin
        ]);

        // Tạo người dùng thường
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('abc12345'), // Mã hóa mật khẩu
            'role' => 'user', // Vai trò user
        ]);
    }
}

