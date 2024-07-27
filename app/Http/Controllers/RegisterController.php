<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class RegisterController extends Controller
{
	/**
	 * Display the view.
	 */
	public function show()
	{
		return Inertia::render('Auth/Register', [
			'heading' => 'Registrieren - '.env('APP_NAME', ''),
		]);
	}

	/**
	 * Register a new user.
	 */
	public function register(Request $request)
	{
		// Define validation rules
		$rules = [
			'email' => ['required', 'email', 'unique:users,email', 'max:255'],
			'nickname' => ['required', 'unique:users,nickname', 'max:255'],
			'first_name' => ['required', 'max:255'],
			'last_name' => ['required', 'max:255'],
			'password' => ['required', 'confirmed', 'min:8'],
		];

		// Create a validator instance
		$validator = Validator::make($request->all(), $rules, [
			'email.unique' => 'Diese E-Mail wird bereits verwendet',
			'nickname.unique' => 'Dieser Nickname wird bereits verwendet',
			'password.confirmed' => 'Passwörter stimmen nicht überein',
			'password.min' => 'Passwort muss mindestens 8 Zeichen lang sein',
			'required' => 'Dieses Feld wird benötigt',
		]);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'message' => 'Validation Error',
				'errors' => $validator->errors(),
				'success' => false,
			], 422);
		}

		// Create the user
		$user = User::create([
			'email' => $request->email,
			'nickname' => $request->nickname,
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'password' => $request->password,
		]);

		// Send the verification email
		$user->notify(new VerifyEmail());

		// Return success
		return response()->json([
			'message' => 'Benutzer wurde erstellt und eine E-Mail zur Bestätigung wurde versendet. Bitte überprüfen Sie Ihren Posteingang.',
			'success' => true,
			'data' => $user,
		], 200);
	}
}
