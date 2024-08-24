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

        // Create an admin user
        $admin = User::create([
            'first_name' => $adminFirstName,
            'last_name' => $adminLastName,
            'nickname' => $adminNickname,
            'profile_seed' => $adminNickname,
            'email' => $adminEmail,
            'password' => bcrypt($adminPassword),
            'email_verified_at' => now(),
            'role' => Roles::ADMIN,
            'remember_token' => Str::random(12),
        ]);


        // Create my lines
        Line::create([
            'line' => 'Ist der Hund im Zwinger am knurren, gehe ich lieber aussen durren!',
            'active' => true,
            'user_id' => $admin->id,
        ]);

        Line::create([
            'line' => 'Auf dem Berg da steht ein Gitzi, und es luegt nitzi!',
            'active' => true,
            'user_id' => $admin->id,
        ]);

        Line::create([
            'line' => 'Ide Migros gits alles zum haube Priiiis!',
            'active' => true,
            'user_id' => $admin->id,
        ]);

        Line::create([
            'line' => 'Schneewittchen hat einen geilen Po, super Titten sowieso. Jeden Abend wilden Sex, mit den Zwegen eins bis sechs.<br/><br/>Nur der siebte schwule Zwerg, fickt mit Hänschen hinter dem Berg!',
            'active' => true,
            'user_id' => $admin->id,
        ]);

        Line::create([
            'line' => 'Prinzesschen warum seit so errötet, hat euch jemand durchgeflötet?<br/><br/>Ja mein Herr, Prinz Theodor, mit sienem langen Ofenrohr!<br/><br/>Prinz Theodor warst du der Schufft, der mein Prinzesschen in den Arsch gepufft?<br/><br/>Oh ja, bitte lass Gnade walten!<br/><br/>Nein,ich werde dir die Eier spalten!<br/><br/>Ein kurzer Schnitt ein langer Schrei und über den Tisch rollt ein halbes Ei!<br/><br/>Und die Moral von der Geschicht halbe Eier rollen nicht!',
            'active' => true,
            'user_id' => $admin->id,
        ]);
    }
}
