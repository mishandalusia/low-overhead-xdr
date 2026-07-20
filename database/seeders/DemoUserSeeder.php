<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // Remove old demo/placeholder accounts — this app has a single real login account.
        User::where('email', 'nabila@lox.test')->delete();
        User::whereIn('email', ['dev@lox.com', 'analyst@lox.com', 'webadmin@lox.com', 'sr7915580@gmail.com'])->delete();

        $users = [
            [
                'name' => 'Administrator',
                'email' => 'suciramadhani@sr15.my.id',
                'password' => 'admin123',
                'role' => 'super_admin',
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
