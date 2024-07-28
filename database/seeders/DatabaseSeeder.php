<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Line;
use App\Enums\Roles;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
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

        // Get environment variables for admin user
        $adminFirstName = env('ADMIN_FIRST_NAME');
        $adminLastName = env('ADMIN_LAST_NAME');
        $adminNickname = env('ADMIN_NICKNAME');
        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');

        // Log the admin user environment variables
        Log::info('Admin User Environment Variables', [
            'first_name' => $adminFirstName,
            'last_name' => $adminLastName,
            'nickname' => $adminNickname,
            'email' => $adminEmail,
        ]);

        // Check if any of the required environment variables are missing
        if (empty($adminFirstName) || empty($adminLastName) || empty($adminNickname) || empty($adminEmail) || empty($adminPassword)) {
            throw new \Exception('Missing environment variables for admin user.');
        }

        // Create an admin user
        User::create([
            'first_name' => $adminFirstName,
            'last_name' => $adminLastName,
            'nickname' => $adminNickname,
            'email' => $adminEmail,
            'password' => bcrypt($adminPassword),
            'email_verified_at' => now(),
            'role' => Roles::ADMIN,
            'remember_token' => Str::random(12),
        ]);
    }
}
