<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@themanthanschool.test')],
            [
                'name' => 'School Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin@12345')),
            ]
        );
    }
}
