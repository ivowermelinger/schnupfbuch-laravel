<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Line;
use App\Enums\Roles;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(5)->create();
         Line::factory(5)->create();

         // Create a admin user
        User::create([
            'first_name' => env('ADMIN_FIRST_NAME'),
            'last_name' => env('ADMIN_LAST_NAME'),
            'nickname' => env('ADMIN_NICKNAME'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'email_verified_at' => now(),
            'role' => Roles::ADMIN,
            'remember_token' => Str::random(12),
        ]);
    }
}
