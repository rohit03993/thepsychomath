<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@thepsychomath.org'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'), // Change this password after first login!
                'email_verified_at' => now(),
            ]
        );
    }
}