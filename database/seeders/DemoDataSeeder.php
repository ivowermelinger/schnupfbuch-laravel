<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{

		// Reset users & lines
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        Line::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	
		$admin = User::create([
			'first_name' => getenv('ADMIN_FIRST_NAME'),
			'last_name' => getenv('ADMIN_LAST_NAME'),
			'email' => getenv('ADMIN_EMAIL'),
			'nickname' => getenv('ADMIN_NICKNAME'),
			'password' => getenv('ADMIN_PASSWORD'),
			'profile_seed' => getenv('ADMIN_EMAIL'),
		]);


		$admin = User::where('email', getenv('ADMIN_EMAIL'))->first();

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
