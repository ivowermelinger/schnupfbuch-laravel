<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;

class RegisterController extends Controller
{
	/**
	 * Display the view.
	 */
	public function show()
	{
		return Inertia::render('Register', [
			'heading' => 'Registrieren - '.env('APP_NAME', ''),
		]);
	}

	/**
	 * Display the verify page.
	 */
	public function verify()
	{
		return view('verify');
	}

	public function verifyEmail(Request $request)
	{
		$user = User::find($request->route('id'));

		if (!$user) {
			throw new AuthorizationException();
		}

		// Verify the email hash
		if (!hash_equals(sha1($user->getEmailForVerification()), (string) $request->route('hash'))) {
			throw new AuthorizationException();
		}

		// Mark the email as verified
		if (!$user->hasVerifiedEmail()) {
			$user->markEmailAsVerified();
			$user->remember_token = Str::random(60);
			$user->save();
		}

		// Redirect to login page with a success message
		return redirect('/')->with('verified', true);
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
			'has_account' => true,
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
