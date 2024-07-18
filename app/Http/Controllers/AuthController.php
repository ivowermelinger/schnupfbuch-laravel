<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * Handle an authentication attempt.
	 *
	 * @return Response
	 */
	public function authenticate(Request $request)
	{
		// Check if has no account
		$user = User::where('email', $request->email)->first();

		// Check if email is verified
		if (!$user->hasVerifiedEmail()) {
			return response()->json([
				'message' => 'Bitte bestätigen Sie Ihre E-Mail-Adresse, um sich einloggen zu können.',
				'success' => false,
			], 401);
		}

		if (!$user->has_account) {
			return response()->json([
				'message' => 'Für diese E-Mail-Adresse wurden bereits Sprüche erfasst, aber kein Konto erstellt. Bitte registrieren Sie sich zuerst.',
				'success' => false,
			], 401);
		}

		// Define validation rules
		$rules = [
			'email' => ['required', 'email'],
			'password' => ['required'],
		];

		// Create a validator instance
		$validator = Validator::make($request->all(), $rules);

		// Check if validation fails
		if ($validator->fails()) {
			return response()->json([
				'message' => 'Validation Error',
				'errors' => $validator->errors(),
				'success' => false,
			], 422);
		}

		// Get validated credentials
		$credentials = $validator->validated();

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			return response()->json([
				'message' => 'User authenticated',
				'success' => true,
			], 200);
		}

		// Send response with status code 401
		return response()->json([
			'message' => 'Benutzername oder Passwort falsch. Bitte versuchen Sie es erneut.',
			'success' => false,
		], 401);
	}

	/**
	 * Log the user out of the application.
	 */
	public function logout(Request $request): RedirectResponse
	{
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}
}
