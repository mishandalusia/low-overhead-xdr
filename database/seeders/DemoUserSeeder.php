<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Remove old demo account if it was already created before
        User::where('email', 'nabila@lox.test')->delete();

        $users = [
            [
                'name' => 'Project Lead',
                'email' => 'lead@lox.com',
                'password' => 'admin123',
                'role' => 'super_admin',
            ],
            [
                'name' => 'Web Admin',
                'email' => 'webadmin@lox.com',
                'password' => 'admin123',
                'role' => 'web_admin',
            ],
            [
                'name' => 'Security Analyst',
                'email' => 'analyst@lox.com',
                'password' => 'admin123',
                'role' => 'security_analyst',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                ]
            );
        }
    }
}